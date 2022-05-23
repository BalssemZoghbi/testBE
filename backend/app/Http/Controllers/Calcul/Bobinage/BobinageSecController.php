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
            public function collierBt2($hbobt,$hsfs){
                return ($hbobt-$hsfs)/2;
            }
            public function DintBint($dn,$cmbt){

                return $dn+(2*$cmbt);
            }
            public function Epx($typeCanaux,$saillie,$e2r,$etage,$nbCouche,$canauxBt,$lgCales,$nbrPapierMT,$ep1Papier){
                if($typeCanaux=='complet'){
                    return ($saillie+$e2r)*$etage*$nbCouche+($canauxBt*$lgCales)+$nbrPapierMT*$ep1Papier;
                }else if($typeCanaux=='lune'){
                    return ($saillie+$e2r)*$etage*$nbCouche;
                }
            }
            // public function Epx($typeCanaux,$saillie,$e2r,$etage,$nbCouche,$canauxBt,$lgCales,$nbPapier,$ep1Papier){
            //     if($typeCanaux=='complet'){
            //         // dd($saillie);
            //         return ($saillie+$e2r)*$etage*$nbCouche+$canauxBt*$lgCales+$nbPapier*$ep1Papier;
            //     }else if($typeCanaux=='lune'){
            //         return ($saillie+$e2r)*$etage*$nbCouche;
            //     }
            // }
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
        // dd($conducteur);
    if($conducteur =='Rond emaille'){
    return $I1phase/$J1d ;
    }else{
        // dd($J1d);
    return 0 ;
    }

    }
    public function D1d($su1d,$brin){
    return 2*sqrt($su1d/(pi()*$brin));
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
    public function hCondMt($filObtenueisole,$spchb,$brin){
        return $spchb*$filObtenueisole*$brin;
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
public function bintMt($bext,$distance,$epbarre,$conducteurmt){
    if ($conducteurmt=="feuillard"){
        return ($distance*2)+$bext+$epbarre;
     }
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
            ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('donne_bobines', 'donne_bobines.id', '=', 'projets.donne_bobines_id')
            ->where('projets.id',$id)
            ->select('bobinage_secs.*','bobinage_secs.id as bobine_id','donne_bobines.materiauBT','bobinages.epaisseurBarre','donne_bobines.conducteurBT','donne_bobines.conducteurMT','volt_Spires.N2c','bobinages.HbobineBt','volt_Spires.Vsp','volt_Spires.spire','gradins.diamNominale','gradins.CMBT','electriques.secondaireIPhase', 'projets.*')
            ->get()->first();
            $Bobinage=BobinageSec::FindOrFail($projet->bobine_id );

            $su1d=$this->su1d($request->conducteurBT,$projet->secondaireIPhase,$request->J2D);

            if($projet->conducteurBT=='Rond emaille'){
                $D1d=$this->D1d($su1d,$request->brinParalleleBT);
                $filobtenue=$this->filobtenue($D1d);
                $Designation=$filobtenue->Designation;
                $Isole=$filobtenue->Isole;
            }else{
                $Designation=0;
                $Isole=0;
            }
            $epFeuillard=$this->epFeuillard($request->epFeuil1BT,$request->epFeuil2BT);
            $scu2=$this->Scu2($projet->conducteurBT,$request->hbrin1BT, $request->hbrin2BT,$request->nbBrin1BT, $request->nbBrin2BT, $request->etageBT, $request->saillieBT,$request->HfeuillardBT,$epFeuillard,$Designation,$request->brinParalleleBT);
            $j2=$this->j2($projet->secondaireIPhase, $scu2);
            $spCouche=$this->spCouche($projet->conducteurBT,$projet->N2c,$request->nbcoucheBT);
            $hSpire=$this->hSpire($request->hbrin1BT,$request->e2ax,$request->nbBrin1BT,$request->hbrin2BT,$request->nbBrin2BT);
            $hsfs=$this->hsfs($hSpire,$spCouche,$request->etageBT,$request->hbrin1BT,$request->hbrin2BT,$request->e2ax);
            $hfs=$this->hfs($hSpire,$spCouche,$request->etageBT,$request->hbrin1BT,$request->hbrin2BT,$request->e2ax);
            $hbobt=$this->hbobt($hfs,$request->collierBTSec);
            $collierBt2=$this->collierBt2($hbobt,$hsfs);
            $DintBint=$this->DintBint($projet->diamNominale,$projet->CMBT);
            $epx=$this->Epx($request->typeCanauxBT,$request->saillieBT,$request->e2r,$request->etageBT,$request->nbcoucheBT,$request->canauxBT,$request->lgCalesBT,$request->nbrPapierBT,$request->canauxEp1PapierBT);
            $epyMeplat=$this->Epy($request->saillieBT,$request->e2r,$request->etageBT,$request->nbcoucheBT,$request->canauxBT,$request->lgCalesBT,$request->nbrPapierBT,$request->canauxEp1PapierBT);
            $dext=$this->Dext($DintBint,$epx);
            $bext=$this->Bext($DintBint,$epyMeplat);
            $poid=$this->Poid($projet->materiauBT,$projet->N2c,$scu2,$DintBint,$epx,$request->majPoidBT);

            $barre=$this->calculBarre($request->EpbarreBT);
            // dd($barre);
            $HbobineBt= $this->Hbobine($request->HfeuillardBT,$request->collierBTSec);
            $ePap=$this->ePap($request->ep1PapierBT,$request->nbrPap1BT,$request->ep1PapierBT,$request->nbrPap2BT);
            $epxfeui=$this->Epxfeui($request->typeCanauxBT,$projet->N2c,$request->canauxBt,$request->lgCalesBT,$epFeuillard,$ePap);
            $epFeuilpap=$this->epPapier($request->epFeuilPapBT,$request->nbrPapierBT);
            $epPapier=$this->epPapier($epFeuilpap,$request->nbPapierBT);

            if($barre!=null){
            $Sbarre=$this->Sbarre($projet->conducteurBT,$barre->epaisseur,$barre->largeur);
            $Jbarre=$this->Jbarre($projet->conducteurBT,$projet->secondaireIPhase,$Sbarre);
            $dextfeui=$this->Dext($DintBint,$epxfeui);
            $Bextfeui=$this->Bextfeui($DintBint,$epxfeui,$barre->epaisseur);
            $PoidFeui=$this->PoidFeui($projet->materiauBT,$dextfeui,$DintBint,$DintBint,$request->majPoidBT,$Bextfeui,$projet->N2c,$scu2);
        }
        $N1cmax=$this->N1cmax($projet->spire);

        $spchb=$this->spchb($projet->conducteurBT,$N1cmax,$request->nbcoucheBT);
        $ncha=$this->ncha($request->nbcoucheBT,$spchb,$N1cmax);
        $nchb=$this->nchb($request->nbcoucheBT,$ncha);
        $spcha=$this->spcha($spchb);
        $HcondMt=$this->hcondMt($Isole,$spchb,$request->brinParalleleBT);

        $Hcollier=$this->Hcollier($projet->HbobineBt,$HcondMt);
        $nbrPapierMT=$this->NbrePapier($projet->conducteurBT,$request->rigiditePapierBT,$spchb,$projet->Vsp,$Isole,$Designation,$request->EpfeuillePapierBT);
      $epaisseurPapier=$this->epaisseurPapier($request->EpfeuillePapierBT, $nbrPapierMT);

        $EpxMt=$this->EpxMt($request->typeCanauxBT,$request->nbcoucheBT,$Isole,$epaisseurPapier,$request->canauxMT,$request->lgCalesBT,$request->EpaisseurPapierCanauxBT);
       $dintMt=$this->dintMt($projet->DextBT,$request->DistanceBTMTSec);
        $bintMt=$this->bintMt($projet->BextBT,$request->DistanceBTMTSec,$projet->epaisseurBarre,$projet->conducteurMT);
if($request->typeCanauxBT=="complet"){

            $epy=$EpxMt;

        }else if($request->typeCanauxBT=="lune"){
            $epy=$this->epyMtLune($request->nbcoucheMT,$Isole,$epaisseurPapier,$request->canauxBT,$request->lgCales);
        }
        $dextMt=$this->dextMt($dintMt,$EpxMt);
        $BextMt=$this->BextMt($bintMt,$epy);
        $poidEmaille=$this->poidEmaille($projet->materiauBT,$dextMt,$dintMt,$dintMt,$request->majPoidBT,$dextMt,$N1cmax,$scu2);
          if($projet->conducteurBT=='meplat guipé'){
                $Bobinage->update([
                        'materiauSec'=> $projet->materiauBT,
                        'conducteurSec'=> $projet->conducteurBT,
                        'etageBT'=> $request->etageBT,
                        'saillieBT'=> $request->saillieBT,
                        'hbrin1BT'=> $request->hbrin1BT,
                        'hbrin2BT'=> $request->hbrin2BT,
                        'nbBrin1BT'=>$request->nbBrin1BT,
                        'nbBrin2BT'=>$request->nbBrin2BT,
                        'scu2'=>$scu2,
                        'j2'=>$j2,
                        'nbcoucheBT'=>$request->nbcoucheBT,
                        'spCoucheBT'=>$spCouche,
                        'e2ax'=>$request->e2ax,
                        'e2r'=>$request->e2r,
                        'rigiditePapierBT'=>$request->rigiditePapierBT,
                        'ep1PapierBT'=>$request->ep1PapierBT,
                        'nbrPapierBT'=>$request->nbrPapierBT,
                        'typeCanauxBT'=>$request->typeCanauxBT,
                        'canauxBT'=>$request->canauxBT,
                        'lgCalesBT'=>$request->lgCalesBT,
                        'canauxEp1PapierBT'=>$request->canauxEp1PapierBT,
                        'canauxNbrPapierBT'=>$request->canauxNbrPapierBT,
                        'HspireBT'=>$hSpire,
                        'HSFSBT'=>$hsfs,
                        'HFSBT'=>$hfs,
                        'collierBTSec'=>$request->collierBTSec,
                        'collierBT2Sec'=> $collierBt2,
                        'CMBTSec'=>$projet->CMBT,
                        'DintBT'=>$DintBint,
                        'BintBT'=>$DintBint,
                        'EpxBT'=>$epx,
                        'EpyBT'=>$epyMeplat,
                        'DextBT'=>$dext,
                        'BextBT'=>$bext,
                        'poidBT'=>$poid,
                        'majPoidBT'=>$request->majPoidBT,
                        'HbobineBtSec'=>$hbobt,
                        ]);
            }else if($projet->conducteurBT=='feuillard'){

                $Bobinage->update([
                    'materiauSec'=> $projet->materiauBT,
                    'conducteurSec'=> $projet->conducteurBT,
                    'scu2'=>$scu2 ,
                    'j2'=>$j2 ,
                    'ep1PapierBT'=>$request->ep1PapierBT ,
                    'nbrPapierBT'=>$request->nbrPapierBT ,
                    'typeCanauxBT'=>$request->typeCanauxBT ,
                    'canauxBT'=>$request->canauxBt ,
                    'lgCalesBT'=>$request->lgCalesBT ,
                    'collierBTSec'=>$request->collierBTSec ,
                    'collierBT2Sec'=> $collierBt2 ,
                    'CMBTSec'=>$projet->CMBT ,
                    'DintBT'=>$DintBint ,
                    'BintBT'=>$DintBint ,
                    'EpxBT'=>$epxfeui ,
                    'EpyBT'=>$epxfeui ,
                    'DextBT'=>$dextfeui ,
                    'BextBT'=>$Bextfeui ,
                    'poidBT'=>$PoidFeui ,
                    'majPoidBT'=>$request->majPoidBT ,
                    'HfeuillardBT'=>$request->HfeuillardBT ,
                    'HbobineBtSec'=>$HbobineBt ,
                    'epFeuil1BT'=>$request->epFeuil1BT ,
                    'epFeuil2BT'=>$request->epFeuil2BT ,
                    'epFeuillardBT'=>$epFeuillard ,
                    'ep2PapierBT'=>$request->ep2PapierBT ,
                    'nbrPap2BT'=>$request->nbrPap2BT ,
                    'ePapBT'=>$ePap ,
                    'epFeuilPapBT'=>$epFeuilpap ,
                    'nbrPap1BT'=>$request->nbrPap1BT ,
                    'EpPapierBT'=>$epPapier ,
                    'EpCylindreBT'=>$request->EpCylindreBT ,
                    'EpbarreBT'=>$request->EpbarreBT ,
                    // 'designationBarreBT'=>$request->designationBarreBT,
                    'epaisseurBarreBT'=>$barre->epaisseur ,
                    'largeurBarreBT'=>$barre->largeur ,
                    'SbarreBT'=>$Sbarre ,
                    'JbarreBT'=>$Jbarre ,
                    ]);
            }else if($projet->conducteurBT=='Rond emaille'){

                $Bobinage->update([
                    'materiauSec'=> $projet->materiauBT,
                    'conducteurSec'=> $projet->conducteurBT,
                    'scu2'=>$scu2 ,
                    'j2'=>$j2 ,
                    'nbrPapierBT'=>$nbrPapierMT ,
                    'typeCanauxBT'=>$request->typeCanauxBT ,
                    'canauxBT'=>$request->canauxBT ,
                    'lgCalesBT'=>$request->lgCalesBT ,
                    'DintBT'=>$dintMt ,
                    'BintBT'=>$bintMt ,
                    'EpxBT'=>$EpxMt ,
                    'EpyBT'=>$epy ,
                    'DextBT'=>$dextMt ,
                    'BextBT'=>$BextMt ,
                    'poidBT'=>$poidEmaille ,
                    'majPoidBT'=>$request->majPoidBT ,
                    'HbobineBtSec'=>$projet->HbobineBt ,
                    'EpCylindreBT'=>$request->EpCylindreBT ,
                    'rigiditePapierBT'=>$request->rigiditePapierBT ,
                     'N2cmax'=>$N1cmax,
                    'scu2d'=>$su1d ,
                    'J2D'=>$request->J2D ,
                    'D2d'=>$D1d ,
                    'filobtenueNueBT'=>$Designation ,
                    'filobtenueIsolerBT'=>$Isole ,
                    'choixBT'=>$request->choixBT ,
                    'brinParalleleBT'=>$request->brinParalleleBT ,
                    'nbcoucheBT'=>$request->nbcoucheBT ,
                    'SpchBBT'=>$spchb ,
                    'NchBBT'=>$nchb ,
                    'SpchABT'=>$spcha ,
                    'NchABT'=>$ncha ,
                    'HCondBt'=>$HcondMt ,
                    'DistanceBTMTSec'=>$request->DistanceBTMTSec ,
                    'HCollierBT'=>$Hcollier ,
                    'EpfeuillePapierBT'=>$request->EpfeuillePapierBT ,
                    'EpaiseurPapierBT'=>$epaisseurPapier ,
                    'EpaisseurPapierCanauxBT'=>$request->EpaisseurPapierCanauxBT
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
