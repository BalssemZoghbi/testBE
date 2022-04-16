<?php

namespace App\Http\Controllers;
use App\Models\Bobinage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BobinageResource;
use App\Models\Barre;
use App\Models\Emaille;

class BobinageController extends Controller
{
    public function getAllBobine()
    {
        $Bobinages =Bobinage::all();

        return BobinageResource::collection($Bobinages);
    }
    public function getOneBobine($id)
    {

        $Bobinage =Bobinage::FindOrFail($id);
        return new BobinageResource($Bobinage);
    }
    public function storeBobinage(Request $request){

        $Bobinage= Bobinage::create([
            'materiau'=> $request->materiau,
            'conducteur'=> $request->conducteur,

         ]);

         if($Bobinage->save()){
             return response()->json($Bobinage);
         }

     }
//meplat guipé
     public function Scu2($conducteur,$hbrin1,$hbrin2,$nbrin1,$nbrin2,$etage,$saillie,$Hfeuillard,$epFeuillard,$filobtenueNue)
     {
        if($conducteur=='meplat guipé'){
         return 0.987*$saillie*$etage*($hbrin1*$nbrin1+$hbrin2*$nbrin2);
        }else if($conducteur=='feuillard'){
            return $Hfeuillard*$epFeuillard;
        }else if($conducteur=='Rond emaille'){
            return (pi()*$filobtenueNue*2)/4;
        }
     }
     public function j2($I2phase,$scu2)
     {
        //  dd($I2phase);
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

        public function epFeuillard($epFeuil1,$epFeuil2){
            return $epFeuil1+$epFeuil2;
        }





//
    public function su1d($conducteur,$I1phase,$J1d){
        if($conducteur=="meplat guipé"){
            return 0;

        }else{
            return $I1phase/$J1d;}

    }
    public function D1d($su1d){
    return 2*sqrt($su1d/pi());
    }
    public function N1cmax($N1cmax){
        $N1cmax = str_replace("[","",$N1cmax);
        $N1cmax = str_replace("]","",$N1cmax);
        $N1cmax=explode(',',$N1cmax);
        return (float)$N1cmax[0];
    }

    public function filobtenue($d1d){
    $filObtenue=Emaille::where('designation',$d1d)->get()->first();
    if($filObtenue==null){
        $filObtenue=Emaille::where('designation','<=',$d1d)->orderBy('designation','desc')->get()->first();
    }
    return $filObtenue;
    }

    public function spchb($conducteur,$n1cMax,$nbCoucheMt){
        if($conducteur=='Rond emaille'){
            return $n1cMax/$nbCoucheMt;
        }else{
            return 0;
            }
    }
    public function ncha($nbCoucheMt,$spchb,$n1cmax){
        return ($nbCoucheMt*$spchb)-$n1cmax;
    }
    public function nchb($nbCoucheMt,$ncha){
        return $nbCoucheMt-$ncha;
    }
    public function spcha($spchb){
        return $spchb-1 ;
    }
    public function hCondMt($filObtenueisole,$spchb){
        return $spchb*$filObtenueisole;
    }
    public function Hcollier($hBobine,$HcondMt){
        return ($hBobine-$HcondMt)/2;
    }
    public function NbrePapier($conducteur,$rigidite,$spchb,$vsp,$filIsole,$filNue){
        if($conducteur=="Rond emaille"){
            return ($rigidite/($spchb*$vsp*4))-($filIsole-$filNue);
        }else{
            return 0;
        }
        }
    public function epaisseurPapier($epfeuille,$nbrepapier){
        return ($epfeuille*$nbrepapier);
    }
    public function dintMt($bext,$distance){
        return ($distance*2)+$bext;
    }
    public function EpxMt($typecanaux,$nbreCoucheMt,$fileisole,$epaisseurPapier,$canauxMt,$lrgc,$epaisseurPapierCanaux){
        if($typecanaux=='complet'){
        return ($nbreCoucheMt*$fileisole+$epaisseurPapier)*($nbreCoucheMt-1-$canauxMt)+$canauxMt*$lrgc+$canauxMt*$epaisseurPapierCanaux;
        }else if($typecanaux=='lune'){
            return ($nbreCoucheMt*$fileisole+$epaisseurPapier)*($nbreCoucheMt-1);
        }
    }
    public function dextMt($dint,$epxmt){
        return ($epxmt*2)+$dint;
    }
    public function epyMtLune($nbreCoucheMt,$fileisole,$epaisseurPapier,$canauxMt,$lrgc){
        return  ($nbreCoucheMt*$fileisole+$epaisseurPapier)*($nbreCoucheMt-1)+$canauxMt*$lrgc;
    }
    public function BextMt($typeconducteur,$dext,$bint,$epy){
        if($typeconducteur=='complet'){
            return $dext;
        }else if($typeconducteur=='lune'){
            return $bint+2*$epy;
        }
    }
    public function poidEmaille($materiau,$dext,$bint,$dint,$majPoid,$bext,$n1cMax,$scu2){
        if($materiau=='cuivre'){
            $coefPoid=8.9;
            $coefPerte=2.286;
        }else if($materiau=='aluminium'){
            $coefPoid=2.7;
            $coefPerte=12.18;
        }
        return pow(10,-6)*($coefPoid*3*pi()*$n1cMax*$scu2)*(($dint+$bint+$dext+$bext)/4)*(100+$majPoid)/100;
    }

        public function updateBobinage($id, Request $request){

            $projet = DB::table('projets')
            ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
            ->where('projets.id',$id)
            ->select('bobinages.*','bobinages.id as bobine_id','volt_Spires.Vsp','volt_Spires.N1c','volt_Spires.spire','electriques.PrimaireIPhase','gradins.diamNominale','electriques.secondaireIPhase','bobinage_secs.HbobineBt','bobinage_secs.Dext','bobinage_secs.Bext','projets.*')
            ->get()->first();
            $Bobinage=Bobinage::FindOrFail($projet->bobine_id );
            $epFeuillard=$this->epFeuillard($request->epFeuil1,$request->epFeuil2);
            $scu2=$this->Scu2($request->conducteur,$request->hbrin1, $request->hbrin2,$request->nbBrin1, $request->nbBrin2, $request->etage, $request->saillie,$request->Hfeuillard,$epFeuillard,1.32);
            $j2=$this->j2($projet->PrimaireIPhase, $scu2);
            $spCouche=$this->spCouche($request->conducteur,$projet->N1c,$request->nbcouche);
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
            $poid=$this->Poid($request->materiau,$projet->N1c,$scu2,$DintBint,$epx,$request->majPoid);

            // $filobtenue=$this->filobtenue(0.51);
            // dd($filobtenue);
            $N1cmax=$this->N1cmax($projet->spire);
            $su1d=$this->su1d($request->conducteur,$projet->PrimaireIPhase,$request->J1D);
            $D1d=$this->D1d($su1d);
            $filobtenue=$this->filobtenue($D1d);
            $spchb=$this->spchb($request->conducteur,$N1cmax,$request->nbCoucheMt);
            $ncha=$this->ncha($request->nbCoucheMt,$spchb,10);
            $nchb=$this->nchb($request->nbCoucheMt,$ncha);
            $spcha=$this->spcha($spchb);
            $HcondMt=$this->hcondMt(1.42,$spchb);
            $Hcollier=$this->Hcollier($projet->HbobineBt,$HcondMt);
            $nbpapier=$this->NbrePapier($request->conducteur,$request->rigiditePapier,$spchb,$projet->Vsp,1.42,1.32);
            $epaisseurPapier=$this->epaisseurPapier($request->EpfeuillePapier, $nbpapier);
            $EpxMt=$this->EpxMt($request->typeCanaux,$request->nbCoucheMt,1.42,$epaisseurPapier,$request->canauxMT,$request->lgCales,$request->EpaisseurPapierCanaux);
            $dintMt=$this->dintMt($projet->Bext,$request->DistanceBTMT);
            $dextMt=$this->dextMt($dintMt,$EpxMt);
            $BextMt=$this->BextMt($request->typeCanaux,$dextMt,$dintMt,$epy);
            $poidEmaille=$this->poidEmaille($request->materiau,$dextMt,$dintMt,$dintMt,$request->majPoid,$dextMt,$N1cmax,$scu2);
            if($request->typeCanaux=="complet"){
                $epy=$EpxMt;
            }else if($request->typeCanaux=="lune"){
                $epy=$this->epyMtLune($request->nbCoucheMt,1.42,$epaisseurPapier,$request->canauxMT,$request->lgCales);
            }
          if($request->conducteur=='meplat guipé'){
                $Bobinage->update([
                        'materiau'=> $request->materiau,
                        'conducteur'=> $request->conducteur,
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

            }else if($request->conducteur=='Rond emaille'){

                $Bobinage->update([
                    'materiau'=> $request->materiau,
                    'conducteur'=> $request->conducteur,
                    'scu2'=>$scu2,
                    'j2'=>$j2,
                    'nbrPapier'=>$request->nbrPapier,
                    'typeCanaux'=>$request->typeCanaux,
                    'canauxMT'=>$request->canauxMT,
                    'lgCales'=>$request->lgCales,
                    'Dint'=>$dintMt,
                    'Bint'=>$dintMt,
                    'Epx'=>$EpxMt,
                    'Epy'=>$epy,
                    'Dext'=>$dextMt,
                    'Bext'=>$BextMt,
                    'poidBT'=>$poidEmaille,
                    'majPoid'=>$request->majPoid,
                    'HbobineBt'=>$projet->HbobineBt,
                    'EpCylindre'=>$request->EpCylindre,
                    'rigiditePapier'=>$request->rigiditePapier,
                     'N1cmax'=>$N1cmax,
                    'scu1d'=>$su1d,
                    'J1D'=>$request->J1D,
                    'D1d'=>$D1d,
                    'filobtenueNue'=>$filobtenue->Designation,
                    'filobtenueIsoler'=>$filobtenue->Isole,
                    'choix'=>$request->choix,
                     'brinParallele'=>$request->brinParallele,
                    'nbCoucheMt'=>$request->nbCoucheMt,
                    'SpchB'=>$spchb,
                    'NchB'=>$nchb,
                    'SpchA'=>$spcha,
                    'NchA'=>$ncha,
                    'HCondMt'=>$HcondMt,
                    'DistanceBTMT'=>$request->DistanceBTMT,
                    'HCollier'=>$Hcollier,
                    'EpfeuillePapier'=>$request->EpfeuillePapier,
                    'nbrPapier'=>$nbpapier,
                    'EpaiseurPapier'=>$epaisseurPapier,
                    'EpaisseurPapierCanaux'=>$request->EpaisseurPapierCanaux
                    ]);
            }

                return response()->json($Bobinage);
         }

        public function deleteBobinage($id){
            $Bobinage = Bobinage::FindOrFail($id);
            $Bobinage->delete();
            return response()->json('deleted');
        }
}
