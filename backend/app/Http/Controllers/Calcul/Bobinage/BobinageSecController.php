<?php

namespace App\Http\Controllers\Calcul\Bobinage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BobinageSecResource;
use App\Models\Donnees\bobinage\Barre;
use App\Models\Donnees\bobinage\BobinageSec;
use App\Models\Donnees\bobinage\Emaille;

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
     public function Scu2($conducteur,$hbrin1,$hbrin2,$nbrin1,$nbrin2,$etage,$saillie,$Hfeuillard,$epFeuillard,$filobtenueNue,$brin)
     {
        if($conducteur=='meplat guipé'){

         return 0.987*$saillie*$etage*($hbrin1*$nbrin1+$hbrin2*$nbrin2);
        }else if($conducteur=='feuillard'){

            return $Hfeuillard*$epFeuillard;
        }else if($conducteur=='Rond emaille'){
            return (pi()*pow($filobtenueNue,2))*$brin/4;
        }
     }
     public function j2($I2phase,$scu2)
     {
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
                    return ($hspire*($spcouche+1))+($etage-1)*($hbrin1+$hbrin2+($e2ax*2));
                }
            }
            public function hbobt($hfs,$collierBT){
                return $hfs+($collierBT*2);
                // timchi 5
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
            return  pow(10,-6)*($coefPoid*$N2c*$scu2)*($dint+$epx)*pi()*3*((100+$majPoid)/100);
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
            }else{
                   return 0;}
        }
        public function PoidFeui($materiau,$dext,$bint,$dint,$majPoid,$bext,$N2c,$scu2){
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
//rond
    public function su1d($conducteur,$I1phase,$J1d){
    if($conducteur=='feuillard'){
    return 0 ;
    }else{
    return $I1phase/$J1d;
    }

    }
    public function D1d($su1d){
    return 2*sqrt($su1d/pi());
    }
    public function filobtenue($d1d){
        $closest = null;
        $tab=[];
        $Emaille=Emaille::get('Designation');

        foreach ($Emaille as $valeur){
            array_push($tab, $valeur->Designation);
        }
        foreach ($tab as $item) {
           if ($closest === null || abs($d1d - $closest) > abs($item - $d1d)) {
              $closest = $item;
           }
        }
        $filObtenue=Emaille::where('designation',$closest)->get()->first();

        return $filObtenue;
    }

    public function spchb($conducteur,$n1cMax,$nbCoucheMt){
        if($conducteur=='Rond emaille'){
            return Ceil($n1cMax/$nbCoucheMt);
        }else{
            return 0;
            }
    }
    public function ncha($nbCoucheMt,$spchb,$n1cmax){
        return floor(($nbCoucheMt*$spchb)-$n1cmax);
    }
    public function nchb($nbCoucheMt,$ncha){
        return $nbCoucheMt-$ncha;
    }
    public function spcha($spchb){
        return Ceil($spchb-1) ;
    }
    public function hCondMt($filObtenueisole,$spchb){
        return $spchb*$filObtenueisole;
    }
    public function Hcollier($hBobine,$HcondMt){
        return ($hBobine-$HcondMt)/2;
    }
    public function NbrePapier($conducteur,$rigidite,$spchb,$vsp,$filIsole,$filNue,$epaisseurPapier){
        if($conducteur=="Rond emaille"){
             return Ceil(((($spchb*$vsp*4)/$rigidite)-($filIsole-$filNue))/$epaisseurPapier);
        }else{
            return 0;
        }
        }

    public function epaisseurPapier($epfeuille,$nbrepapier){

        return ($epfeuille*$nbrepapier);
    }
    public function dintBt($dext,$distance){
        return ($distance*2)+$dext;
    }
    public function bintBt($bext,$distance){
        return ($distance*2)+$bext;
    }
    public function EpxBt($typecanaux,$nbreCoucheMt,$fileisole,$epaisseurPapier,$canauxMt,$lrgc,$epaisseurPapierCanaux){
        if($typecanaux=='complet'){
        return $nbreCoucheMt*$fileisole+$epaisseurPapier*($nbreCoucheMt-1-$canauxMt)+$canauxMt*$lrgc+$canauxMt*$epaisseurPapierCanaux;
        }else if($typecanaux=='lune'){
            return ($nbreCoucheMt*$fileisole+$epaisseurPapier)*($nbreCoucheMt-1);
        }
    }
    public function dextBt($dint,$epxmt){
        return ($epxmt*2)+$dint;
    }
    public function epyBtLune($nbreCoucheMt,$fileisole,$epaisseurPapier,$canauxMt,$lrgc){
        return  ($nbreCoucheMt*$fileisole+$epaisseurPapier)*($nbreCoucheMt-1)+$canauxMt*$lrgc;
    }
    public function BextBt($bint,$epy){

        return $bint+2*$epy;

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
public function N1cmax($N1cmax){
    $N1cmax = str_replace("[","",$N1cmax);
    $N1cmax = str_replace("]","",$N1cmax);
    $N1cmax=explode(',',$N1cmax);
    return (float)$N1cmax[0];
}
public function EpxMt($typecanaux,$nbreCoucheMt,$fileisole,$epaisseurPapier,$canauxMt,$lrgc,$epaisseurPapierCanaux){
    if($typecanaux=='complet'){
    return $nbreCoucheMt*$fileisole+$epaisseurPapier*($nbreCoucheMt-1-$canauxMt)+$canauxMt*$lrgc+$canauxMt*$epaisseurPapierCanaux;
    }else if($typecanaux=='lune'){

        return $nbreCoucheMt*$fileisole+$epaisseurPapier*($nbreCoucheMt-1);


    }
}
public function dintMt($dext,$distance){
    return ($distance*2)+$dext;
}
public function bintMt($bext,$distance){
    return ($distance*2)+$bext;
}
public function dextMt($dint,$epxmt){
    return ($epxmt*2)+$dint;
}
public function epyMtLune($nbreCoucheMt,$fileisole,$epaisseurPapier,$canauxMt,$lrgc){
    return  ($nbreCoucheMt*$fileisole+$epaisseurPapier)*($nbreCoucheMt-1)+$canauxMt*$lrgc;
}
public function BextMt($bint,$epy){

    return $bint+2*$epy;

}


        public function updateBobinage($id, Request $request){

            $projet = DB::table('projets')
            ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->where('projets.id',$id)
            ->select('bobinage_secs.*','bobinage_secs.id as bobine_id','volt_Spires.N2c','volt_Spires.Vsp','volt_Spires.spire','gradins.diamNominale','gradins.CMBT','electriques.secondaireIPhase', 'projets.*')
            ->get()->first();
            $Bobinage=BobinageSec::FindOrFail($projet->bobine_id );
            $su1d=$this->su1d($projet->conducteurSec,$projet->secondaireIPhase,$request->J2D);

            if($request->conducteurSec=='Rond emaille'){
                $D1d=$this->D1d($su1d);
                $filobtenue=$this->filobtenue($D1d);
                $Designation=$filobtenue->Designation;
                $Isole=$filobtenue->Isole;
            }else{
                $Designation=0;
                $Isole=0;
            }
            $epFeuillard=$this->epFeuillard($request->epFeuil1,$request->epFeuil2);
            $scu2=$this->Scu2($request->conducteurSec,$request->hbrin1, $request->hbrin2,$request->nbBrin1, $request->nbBrin2, $request->etage, $request->saillie,$request->Hfeuillard,$epFeuillard,$Designation,$request->brinParallele);
            $j2=$this->j2($projet->secondaireIPhase, $scu2);
            $spCouche=$this->spCouche($request->conducteurSec,$projet->N2c,$request->nbcouche);
            $hSpire=$this->hSpire($request->hbrin1,$request->e2ax,$request->nbBrin1,$request->hbrin2,$request->nbBrin2);
            $hsfs=$this->hsfs($hSpire,$spCouche,$request->etage,$request->hbrin1,$request->hbrin2,$request->e2ax);
            $hfs=$this->hfs($hSpire,$spCouche,$request->etage,$request->hbrin1,$request->hbrin2,$request->e2ax);
            $hbobt=$this->hbobt($hfs,$request->collierBT);
            $collierBt2=$this->collierBt2($hbobt,$hsfs,$request->collierBT);
            $DintBint=$this->DintBint($projet->diamNominale,$projet->CMBT);

            $epx=$this->Epx($request->typeCanaux,$request->saillie,$request->e2r,$request->etage,$request->nbcouche,$request->canauxBt,$request->lgCales,$request->nbPapier,$request->ep1Papier);
            $epyMeplat=$this->Epy($request->saillie,$request->e2r,$request->etage,$request->nbcouche,$request->canauxBt,$request->lgCales,$request->nbPapier,$request->ep1Papier);
            $dext=$this->Dext($DintBint,$epx);
            $bext=$this->Bext($DintBint,$epyMeplat);
            $poid=$this->Poid($request->materiauSec,$projet->N2c,$scu2,$DintBint,$epx,$request->majPoid);

            $barre=$this->calculBarre($request->Epbarre);

            $HbobineBt= $this->Hbobine($request->Hfeuillard,$request->collierBT);
            $ePap=$this->ePap($request->ep1Papier,$request->nbrPap1,$request->ep2Papier,$request->nbrPap2);
            $epxfeui=$this->Epxfeui($request->typeCanaux,$projet->N2c,$request->canauxBt,$request->lgCales,$epFeuillard,$ePap);
            $epFeuilpap=$this->epPapier($request->epFeuilPap,$request->nbrPapier);
            $epPapier=$this->epPapier($epFeuilpap,$request->nbPapier);

            if($barre!=null){
            $Sbarre=$this->Sbarre($request->conducteurSec,$barre->epaisseur,$barre->largeur);
            $Jbarre=$this->Jbarre($request->conducteurSec,$projet->secondaireIPhase,$Sbarre);
            $dextfeui=$this->Dext($DintBint,$epxfeui);
            $Bextfeui=$this->Bextfeui($DintBint,$epxfeui,$barre->epaisseur);
            $PoidFeui=$this->PoidFeui($request->materiauSec,$dextfeui,$DintBint,$DintBint,$request->majPoid,$Bextfeui,$projet->N2c,$scu2);
        }
        $N1cmax=$this->N1cmax($projet->spire);

        $spchb=$this->spchb($request->conducteurSec,$N1cmax,$request->nbcoucheBT);
        $ncha=$this->ncha($request->nbcoucheMT,$spchb,$N1cmax);
        $nchb=$this->nchb($request->nbcoucheMT,$ncha);
        $spcha=$this->spcha($spchb);
        $HcondMt=$this->hcondMt($Isole,$spchb);
        $Hcollier=$this->Hcollier($projet->HbobineBt,$HcondMt);
        $nbrPapierMT=$this->NbrePapier($request->conducteurSec,$request->rigiditePapierMT,$spchb,$projet->Vsp,$Isole,$Designation,$request->EpfeuillePapier);
      $epaisseurPapier=$this->epaisseurPapier($request->EpfeuillePapier, $nbrPapierMT);

        $EpxMt=$this->EpxMt($request->typeCanaux,$request->nbcoucheBT,$Isole,$epaisseurPapier,$request->canauxMT,$request->lgCales,$request->EpaisseurPapierCanaux);
       $dintMt=$this->dintMt($projet->DextBT,$request->DistanceBTMT);
        $bintMt=$this->bintMt($projet->Bext,$request->DistanceBTMT);
if($request->typeCanaux=="complet"){

            $epy=$EpxMt;

        }else if($request->typeCanaux=="lune"){
            $epy=$this->epyMtLune($request->nbcoucheMT,$Isole,$epaisseurPapier,$request->canauxMT,$request->lgCales);
        }
        $dextMt=$this->dextMt($dintMt,$EpxMt);
        $BextMt=$this->BextMt($bintMt,$epy);
        $poidEmaille=$this->poidEmaille($request->materiauSec,$dextMt,$dintMt,$dintMt,$request->majPoid,$dextMt,$N1cmax,$scu2);
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
                        'CMBT'=>$projet->CMBT,
                        'Dint'=>$DintBint,
                        'Bint'=>$DintBint,
                        'Epx'=>$epx,
                        'Epy'=>$epyMeplat,
                        'DextBT'=>$dext,
                        'Bext'=>$bext,
                        'poidBT'=>$poid,
                        'majPoid'=>$request->majPoid,
                        'HbobineBt'=>$hbobt,
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
                    'CMBT'=>$projet->CMBT,
                    'Dint'=>$DintBint,
                    'Bint'=>$DintBint,
                    'Epx'=>$epxfeui,
                    'Epy'=>$epxfeui,
                    'DextBT'=>$dextfeui,
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
            }else if($request->conducteur=='Rond emaille'){

                $Bobinage->update([
                    'materiauSec'=> $request->materiauSec,
                    'conducteurSec'=> $request->conducteurSec,
                    'scu2'=>$scu2,
                    'j2'=>$j2,
                    'nbrPapierBT'=>$nbrPapierMT,
                    'typeCanaux'=>$request->typeCanaux,
                    'canauxMT'=>$request->canauxMT,
                    'lgCales'=>$request->lgCales,
                    'Dint'=>$dintMt,
                    'Bint'=>$bintMt,
                    'Epx'=>$EpxMt,
                    'Epy'=>$epy,
                    'DextBT'=>$dextMt,
                    'Bext'=>$BextMt,
                    'poidBT'=>$poidEmaille,
                    'majPoid'=>$request->majPoid,
                    'HbobineBt'=>$projet->HbobineBt,
                    'EpCylindre'=>$request->EpCylindre,
                    'rigiditePapierMT'=>$request->rigiditePapierMT,
                     'N1cmax'=>$N1cmax,
                    'scu2d'=>$su1d,
                    'J2D'=>$request->J2D,
                    'D2d'=>$D1d,
                    'filobtenueNue'=>$Designation,
                    'filobtenueIsoler'=>$Isole,
                    'choix'=>$request->choix,
                    'brinParallele'=>$request->brinParallele,
                    'nbcoucheBT'=>$request->nbcoucheMT,
                    'SpchB'=>$spchb,
                    'NchB'=>$nchb,
                    'SpchA'=>$spcha,
                    'NchA'=>$ncha,
                    'HCondBt'=>$HcondMt,
                    'DistanceBTMT'=>$request->DistanceBTMT,
                    'HCollier'=>$Hcollier,
                    'EpfeuillePapier'=>$request->EpfeuillePapier,
                    'EpaiseurPapier'=>$epaisseurPapier,
                    'EpaisseurPapierCanaux'=>$request->EpaisseurPapierCanaux
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
