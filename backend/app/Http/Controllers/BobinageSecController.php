<?php

namespace App\Http\Controllers;
use App\Models\BobinageSec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BobinageSecResource;
use App\Models\Barre;

class BobinageSecController extends Controller
{
    public function getAllBobine()
    {
        $Bobinages =BobinageSec::all();

        return BobinageSecResource::collection($Bobinages);
    }
    public function getOneBobine($id)
    {

        $Bobinage =BobinageSec::FindOrFail($id);
        return new BobinageSecResource($Bobinage);
    }
    public function storeBobinage(Request $request){

        $Bobinage= BobinageSec::create([
            'materiau'=> $request->materiau,
            'conducteur'=> $request->conducteur,

         ]);

         if($Bobinage->save()){
             return response()->json($Bobinage);
         }

     }
//meplat guipé
     public function Scu2($conducteur,$hbrin1,$hbrin2,$nbrin1,$nbrin2,$etage,$saillie,$Hfeuillard,$epFeuillard)
     {
        if($conducteur=='meplat guipé'){

         return 0.987*$saillie*$etage*($hbrin1*$nbrin1+$hbrin2*$nbrin2);
        }else if($conducteur=='feuillard'){
            // dd($epFeuillard);

            return $Hfeuillard*$epFeuillard;
        }
     }
     public function j2($I2phase,$scu2)
     {
        //  dd($scu2);
         return $I2phase/$scu2;
    }
             public function spCouche($conducteur,$N2c,$nbCouche){
                if($conducteur=='meplat guipé'){
                    return $N2c/$nbCouche;
                }else if($conducteur=='feuillard'){
                       return 0;
                   }
             }
             public function hSpire($hbrin1,$e2ax,$nbrin1,$hbrin2,$nbrin2){
                return ($hbrin1+$e2ax)*$nbrin1+($hbrin2+$e2ax)*$nbrin2;
            }
            public function hsfs($hspire,$spcouche,$etage,$hbrin1,$hbrin2,$e2ax){
                return ($hspire*$spcouche)+($etage-1)*($hbrin1+$hbrin2+($e2ax*2));
            }
            public function hfs($hspire,$spcouche,$etage,$hbrin1,$hbrin2,$e2ax){
                if($hbrin1 == 0){
                    return $hspire*$spcouche+($etage-1)*($hbrin1+$e2ax);
                }else{
                    return ($hspire*$spcouche)+($etage-1)*($hbrin1+$hbrin2+($e2ax*2));
                }
            }
            public function hbobt($hfs,$collierBT){
                return $hfs+($collierBT*2);
            }
            public function collierBt2($hbobt,$hsfs,$collierBT){
                return $hbobt-$hsfs-$collierBT;
            }
            public function DintBint($dn,$cmbt){
                return $dn+(2*$cmbt);
            }
            public function Epx($typeCanaux,$saillie,$e2r,$etage,$nbCouche,$canauxBt,$lgCales,$nbPapier,$ep1Papier){
                if($typeCanaux=='complet'){
                    return ($saillie+$e2r)*$etage*$nbCouche+($canauxBt*$lgCales)+$nbPapier*$ep1Papier;
                }else if($typeCanaux=='lune'){
                    return ($saillie+$e2r)*$etage*$nbCouche;
                }
            }
            public function Epy($saillie,$e2r,$etage,$nbCouche,$canauxBt,$lgCales,$nbPapier,$ep1Papier){
               return ($saillie+$e2r)*$etage*$nbCouche+($canauxBt*$lgCales)+$nbPapier*$ep1Papier;

            }
            public function Dext($dint,$epx){
                return $dint+2*$epx;
            }
            public function Bext($dint,$epy){
                return $dint+2*$epy;
            }

            public function Poid($materiau,$N2c,$scu2,$dint,$epx,$majPoid){
            if($materiau=='cuivre'){
                $coefPoid=8.9;
                $coefPerte=2.286;
            }else if($materiau=='aluminium'){
                $coefPoid=2.7;
                $coefPerte=12.18;

            }
            return $coefPoid*$N2c*$scu2*($dint+$epx)*pi()*3*((100+$majPoid)/100);
        }
        //feuillard
        public function Hbobine($Hfeuillard,$collierBT){
            return $Hfeuillard+2*$collierBT;
        }
        public function epFeuillard($epFeuil1,$epFeuil2){
            return $epFeuil1+$epFeuil2;
        }
        public function ePap($ePap,$Npap1,$ePap2,$Npap2){
            return ($ePap*$Npap1)+($ePap2*$Npap2);
        }
        public function epPapier($epFeuilpap,$nbPapier){
            return $epFeuilpap*$nbPapier;
        }
        public function Epxfeui($typeCanaux,$N2c,$canauxBt,$lgCales,$epFeuillard,$ePap){
            if($typeCanaux=='complet'){
                return $N2c*$epFeuillard+($N2c-1)*$ePap+($canauxBt*$lgCales);
            }else if($typeCanaux=='lune'){
                return $N2c*$epFeuillard+($N2c-1)*$ePap;
            }
        }
        public function Bextfeui($bint,$epy,$Epbarre){
            return $bint+2*$epy+$Epbarre;
        }
        public function Sbarre($conducteur,$epaisseur,$largeur){
            if($conducteur=='feuillard'){
                return $epaisseur*$largeur;
               }else if($conducteur=='meplat guipé'){
                   return 0;}
        }
        public function Jbarre($conducteur,$N2c,$sbarre){
            if($conducteur=='feuillard'){
                return $N2c/$sbarre;
            }else if($conducteur=='meplat guipé'){
                   return 0;}
        }
        public function PoidFeui($materiau,$dext,$bint,$dint,$epx,$majPoid,$bext,$epy,$N2c,$scu2){
            if($materiau=='cuivre'){
                $coefPoid=8.9;
                $coefPerte=2.286;
            }else if($materiau=='aluminium'){
                $coefPoid=2.7;
                $coefPerte=12.18;
            }
            // return ($coefPoid*$N2c*$scu2*(((($dint+$dext+$bint+$bext)/4)+($epx+$epy)/2)*pi()*3*(($majPoid+100)/100)))*(pow(10,-6));
            return pow(10,-6)*($coefPoid*3*pi()*$N2c*$scu2)*(($dint+$bint+$dext+$bext)/4)*(100+$majPoid)/100;
        }
        public function calculBarre($designation){
            $barre=Barre::where('designation',$designation)->get()->first();
    return $barre;
}
    public function su1d($I1phase,$J1d){
    return $I1phase/$J1d;

    }
    public function D1d($su1d){
    return 2*sqrt($su1d/pi());
    }
        public function updateBobinage($id, Request $request){

            $projet = DB::table('projets')
            ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->where('projets.id',$id)
            ->select('bobinage_secs.*','bobinage_secs.id as bobine_id','volt_Spires.N2c','volt_Spires.N1c','electriques.PrimaireIPhase','gradins.diamNominale','electriques.secondaireIPhase', 'projets.*')
            ->get()->first();
            $Bobinage=BobinageSec::FindOrFail($projet->bobine_id );
            $epFeuillard=$this->epFeuillard($request->epFeuil1,$request->epFeuil2);
            $scu2=$this->Scu2($request->conducteurSec,$request->hbrin1, $request->hbrin2,$request->nbBrin1, $request->nbBrin2, $request->etage, $request->saillie,$request->Hfeuillard,$epFeuillard);
        //    dd($scu2);
            $j2=$this->j2($projet->PrimaireIPhase, $scu2);
            $spCouche=$this->spCouche($request->conducteurSec,$projet->N1c,$request->nbcouche);
            $hSpire=$this->hSpire($request->hbrin1,$request->e2ax,$request->nbBrin1,$request->hbrin2,$request->nbBrin2);
            $hsfs=$this->hsfs($hSpire,$spCouche,$request->etage,$request->hbrin1,$request->hbrin2,$request->e2ax);
            $hfs=$this->hfs($hSpire,$spCouche,$request->etage,$request->hbrin1,$request->hbrin2,$request->e2ax);
            $hbobt=$this->hbobt($hfs,$request->collierBT);
            $collierBt2=$this->collierBt2($hbobt,$hsfs,$request->collierBT);
            $DintBint=$this->DintBint($projet->diamNominale,$request->CMBT);
            $epx=$this->Epx($request->typeCanaux,$request->saillie,$request->e2r,$request->etage,$request->nbcouche,$request->canauxBt,$request->lgCales,$request->nbPapier,$request->ep1Papier);
            $epy=$this->Epy($request->saillie,$request->e2r,$request->etage,$request->nbcouche,$request->canauxBt,$request->lgCales,$request->nbPapier,$request->ep1Papier);
            $dext=$this->Dext($DintBint,$epx);
            $bext=$this->Bext($DintBint,$epy);
            $poid=$this->Poid($request->materiauSec,$projet->N1c,$scu2,$DintBint,$epx,$request->majPoid);

            $barre=$this->calculBarre($request->Epbarre);
            $HbobineBt= $this->Hbobine($request->Hfeuillard,$request->collierBT);
            $ePap=$this->ePap($request->ep1Papier,$request->nbrPap1,$request->ep2Papier,$request->nbrPap2);
            $epFeuilpap=$this->epPapier($request->epFeuilPap,$request->nbrPapier);
            $epPapier=$this->epPapier($epFeuilpap,$request->nbPapier);
            if($barre!=null){
            $Sbarre=$this->Sbarre($request->conducteurSec,$barre->epaisseur,$barre->largeur);
            $Jbarre=$this->Jbarre($request->conducteurSec,$projet->N1c,$Sbarre);
            $epxfeui=floor($this->Epxfeui($request->typeCanaux,$projet->N1c,$request->canauxBt,$request->lgCales,$epFeuillard,$ePap));
            $dextfeui=$this->Dext($DintBint,$epxfeui);
            $Bextfeui=$this->Bextfeui($DintBint,$epxfeui,$barre->epaisseur);
            $PoidFeui=$this->PoidFeui($request->materiauSec,$dextfeui,$DintBint,$DintBint,$epxfeui,$request->majPoid,$Bextfeui,$epxfeui,$projet->N1c,$scu2);
        }
          if($request->conducteurSec=='meplat guipé'){
                $Bobinage->update([
                        'materiauSec'=> $request->materiauSec,
                        'conducteurSec'=> $request->conducteurSec,
                        'etage'=> $request->etage,
                        'saillie'=> $request->saillie,
                        'hbrin1'=> $request->hbrin1,
                        'hbrin2'=> $request->hbrin2,
                        'nbBrin1'=>$request->nbBrin1,
                        'nbBrin2'=>$request->nbBrin2,
                        'scu2'=>$scu2,
                        'j2'=>$j2,
                        'nbcouche'=>$request->nbcouche,
                        'sp/couche'=>$spCouche,
                        'e2ax'=>$request->e2ax,
                        'e2r'=>$request->e2r,
                        'rigiditePapier'=>$request->rigiditePapier,
                        'ep1Papier'=>$request->ep1Papier,
                        'nbrPapier'=>$request->nbrPapier,
                        'typeCanaux'=>$request->typeCanaux,
                        'canauxBT'=>$request->canauxBt,
                        'lgCales'=>$request->lgCales,
                        'canauxEp1Papier'=>$request->canauxEp1Papier,
                        'canauxNbrPapier'=>$request->canauxNbrPapier,
                        'Hspire'=>$hSpire,
                        'HSFS'=>$hsfs,
                        'HFS'=>$hfs,
                        'collierBT'=>$request->collierBT,
                        'collierBT2'=> $collierBt2,
                        'CMBT'=>$request->CMBT,
                        'Dint'=>$DintBint,
                        'Bint'=>$DintBint,
                        'Epx'=>$epx,
                        'Epy'=>$epy,
                        'Dext'=>$dext,
                        'Bext'=>$bext,
                        'poidBT'=>$poid,
                        'majPoid'=>$request->majPoid,
                        'HBOBT'=>$hbobt,
                        ]);
            }else if($request->conducteurSec=='feuillard'){

                $Bobinage->update([
                    'materiauSec'=> $request->materiauSec,
                    'conducteurSec'=> $request->conducteurSec,
                    'scu2'=>$scu2,
                    'j2'=>$j2,
                    'ep1Papier'=>$request->ep1Papier,
                    'nbrPapier'=>$request->nbrPapier,
                    'typeCanaux'=>$request->typeCanaux,
                    'canauxBT'=>$request->canauxBt,
                    'lgCales'=>$request->lgCales,
                    'collierBT'=>$request->collierBT,
                    'collierBT2'=> $collierBt2,
                    'CMBT'=>$request->CMBT,
                    'Dint'=>$DintBint,
                    'Bint'=>$DintBint,
                    'Epx'=>$epxfeui,
                    'Epy'=>$epxfeui,
                    'Dext'=>$dextfeui,
                    'Bext'=>$Bextfeui,
                    'poidBT'=>$PoidFeui,
                    'majPoid'=>$request->majPoid,
                    'Hfeuillard'=>$request->Hfeuillard,
                    'HbobineBt'=>$HbobineBt,
                    'epFeuil1'=>$request->epFeuil1,
                    'epFeuil2'=>$request->epFeuil2,
                    'epFeuillard'=>$epFeuillard,
                    'ep2Papier'=>$request->ep2Papier,
                    'nbrPap2'=>$request->nbrPap2,
                    'ePap'=>$ePap,
                    'epFeuilPap'=>$epFeuilpap,
                    'nbrPap1'=>$request->nbrPap1,
                    'EpPapier'=>$epPapier,
                    'EpCylindre'=>$request->EpCylindre,
                    'Epbarre'=>$request->Epbarre,
                    'designationBarre'=>$request->designationBarre,
                    'epaisseurBarre'=>$barre->epaisseur,
                    'largeurBarre'=>$barre->largeur,
                    'Sbarre'=>$Sbarre,
                    'Jbarre'=>$Jbarre,
                    ]);
            }
            return response()->json($Bobinage);
         }

        public function deleteBobinage($id){
            $Bobinage = BobinageSec::FindOrFail($id);
            $Bobinage->delete();
            return response()->json('deleted');
        }
}
