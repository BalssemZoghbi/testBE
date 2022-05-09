<?php

namespace App\Http\Controllers\Calcul\Bobinage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BobinageResource;
use App\Models\Donnees\bobinage\Barre;
use App\Models\Donnees\bobinage\Bobinage;
use App\Models\Donnees\bobinage\Emaille;

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
     public function Scu1($conducteur,$hbrin1,$hbrin2,$nbrin1,$nbrin2,$etage,$saillie,$filobtenueNue,$Hfeuillard,$epFeuillard,$brin)
     {
        if($conducteur=='meplat guipé'){

         return 0.987*$saillie*$etage*($hbrin1*$nbrin1+$hbrin2*$nbrin2);
        }else if($conducteur=='Rond emaille'){
            return (pi()*pow($filobtenueNue,2))*$brin/4;
        }else if($conducteur=='feuillard'){
            return $Hfeuillard*$epFeuillard;
        }
    }

     public function j1($I1phase,$scu1)
     {
        // dd($scu1);
         return $I1phase/$scu1;
    }
             public function spCouche($conducteur,$N1c,$nbCouche){
                if($conducteur=='meplat guipé'){
                    return $N1c/$nbCouche;
                }else {
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
            public function Epx($typeCanaux,$saillie,$e2r,$etage,$nbCouche,$canauxBt,$lgCales,$nbrPapierMT,$ep1Papier){
                if($typeCanaux=='complet'){
                    return ($saillie+$e2r)*$etage*$nbCouche+($canauxBt*$lgCales)+$nbrPapierMT*$ep1Papier;
                }else if($typeCanaux=='lune'){
                    return ($saillie+$e2r)*$etage*$nbCouche;
                }
            }
            public function Epy($saillie,$e2r,$etage,$nbCouche,$canauxBt,$lgCales,$nbrPapierMT,$ep1Papier){
               return ($saillie+$e2r)*$etage*$nbCouche+($canauxBt*$lgCales)+$nbrPapierMT*$ep1Papier;

            }
            public function Dext($dint,$epx){
                return $dint+2*$epx;
            }
            public function Bext($dint,$epy){
                return $dint+2*$epy;
            }
            public function Poid($materiau,$N1c,$scu1,$dint,$epx,$majPoid){
            if($materiau=='cuivre'){
                $coefPoid=8.9;
                $coefPerte=2.286;
            }else if($materiau=='aluminium'){
                $coefPoid=2.7;
                $coefPerte=12.18;

            }
            return $coefPoid*$N1c*$scu1*($dint+$epx)*pi()*3*((100+$majPoid)/100);
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
       }else {
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
    public function su1d($conducteur,$I1phase,$J1d){
        if($conducteur=="Rond emaille"){
            return $I1phase/$J1d;

        }else{
            return 0;}

    }
    public function D1d($su1d,$brin){
    return 2*sqrt($su1d/(pi()*$brin));
    }
    public function N1cmax($N1cmax){
        $N1cmax = str_replace("[","",$N1cmax);
        $N1cmax = str_replace("]","",$N1cmax);
        $N1cmax=explode(',',$N1cmax);
        return (float)$N1cmax[0];
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
    public function dintMt($dext,$distance){
        return ($distance*2)+$dext;
    }
    public function bintMt($bext,$distance,$epbarre,$conducteursec){
        if ($conducteursec=="feuillard"){
            return ($distance*2)+$bext+$epbarre;
         }
        return ($distance*2)+$bext;
    }

    public function EpxMt($typecanaux,$nbreCoucheMt,$fileisole,$epaisseurPapier,$canauxMt,$lrgc,$epaisseurPapierCanaux){
        if($typecanaux=='complet'){
        return $nbreCoucheMt*$fileisole+$epaisseurPapier*($nbreCoucheMt-1-$canauxMt)+$canauxMt*$lrgc+$canauxMt*$epaisseurPapierCanaux;
        }else if($typecanaux=='lune'){
            $epx=$nbreCoucheMt*$fileisole+$epaisseurPapier*($nbreCoucheMt-1);
            return Ceil($epx);
        }
    }
    public function dextMt($dint,$epxmt){
        return ($epxmt*2)+$dint;
    }
    public function epyMtLune($nbreCoucheMt,$fileisole,$epaisseurPapier,$canauxMt,$lrgc){
        $epyRond= $nbreCoucheMt*$fileisole+$epaisseurPapier*($nbreCoucheMt-1)+$canauxMt*$lrgc;
        return Ceil($epyRond);
    }
    // public function BextMt($typeconducteur,$bint,$epy){
    //     if($typeconducteur=='complet'){
    //         return $bint+2*$epy;
    //     }else if($typeconducteur=='lune'){
    //         return $bint+2*$epy;
    //     }
    // }
    public function BextMt($bint,$epy){

            return round($bint+2*$epy);

    }
    public function poidEmaille($materiau,$dext,$bint,$dint,$majPoid,$bext,$n1cMax,$scu1){
        if($materiau=='cuivre'){
            $coefPoid=8.9;
            $coefPerte=2.286;
        }else if($materiau=='aluminium'){
            $coefPoid=2.7;
            $coefPerte=12.18;
        }
        return pow(10,-6)*($coefPoid*3*pi()*$n1cMax*$scu1)*(($dint+$bint+$dext+$bext)/4)*(100+$majPoid)/100;
    }

        public function updateBobinage($id, Request $request){

            $projet = DB::table('projets')
            ->join('bobinages', 'bobinages.id', '=', 'projets.bobinage_id')
            ->join('electriques', 'electriques.id', '=', 'projets.electrique_id')
            ->join('volt_Spires', 'volt_Spires.id', '=', 'projets.volt_spires_id')
            ->join('gradins', 'gradins.id', '=', 'projets.gradin_id')
            ->join('bobinage_secs', 'bobinage_secs.id', '=', 'projets.bobinage_secs_id')
            ->where('projets.id',$id)
            ->select('bobinages.*','bobinages.id as bobine_id','volt_Spires.Vsp','volt_Spires.N1c','volt_Spires.N2c','volt_Spires.spire','electriques.PrimaireIPhase','gradins.diamNominale','gradins.CMBT','bobinage_secs.HbobineBtSec','bobinage_secs.epaisseurBarreBT','bobinage_secs.conducteurSec','bobinage_secs.DextBT','bobinage_secs.BextBT','projets.*')
            ->get()->first();

            $Bobinage=Bobinage::FindOrFail($projet->bobine_id );
            // dd($request->canauxMT);
            $su1d=$this->su1d($request->conducteur,$projet->PrimaireIPhase,$request->J1D);

           if($request->conducteur=='Rond emaille'){
               $D1d=$this->D1d($su1d,$request->brinParallele);
            $filobtenue=$this->filobtenue($D1d);
            $Designation=$filobtenue->Designation;
            $Isole=$filobtenue->Isole;
        }else{
            $Designation=0;
            $Isole=0;
        }
        $epFeuillard=$this->epFeuillard($request->epFeuil1,$request->epFeuil2);
// dd($request);
            $scu1=$this->Scu1($request->conducteur,$request->hbrin1MT, $request->hbrin2MT,$request->nbBrin1MT, $request->nbBrin2MT, $request->etageMT, $request->saillieMT,$Designation,$request->Hfeuillard,$epFeuillard,$request->brinParallele);
            $j1=$this->j1($projet->PrimaireIPhase, $scu1);
            $spCouche=$this->spCouche($request->conducteur,$projet->N1c,$request->nbcoucheMT);
            $hSpire=$this->hSpire($request->hbrin1MT,$request->e1ax,$request->nbBrin1MT,$request->hbrin2MT,$request->nbBrin2MT);
            $hsfs=$this->hsfs($hSpire,$spCouche,$request->etageMT,$request->hbrin1MT,$request->hbrin2MT,$request->e1ax);
            $hfs=$this->hfs($hSpire,$spCouche,$request->etageMT,$request->hbrin1MT,$request->hbrin2MT,$request->e1ax);
            $hbobt=$this->hbobt($hfs,$request->collierBT);
            $collierBt2=$this->collierBt2($hbobt,$hsfs,$request->collierBT);
            $DintBint=$this->DintBint($projet->diamNominale,$projet->CMBT);
            $epx=$this->Epx($request->typeCanaux,$request->saillieMT,$request->e1r,$request->etageMT,$request->nbcoucheMT,$request->canauxMT,$request->lgCales,$request->nbrPapierMT,$request->ep1PapierMT);
            $epy=$this->Epy($request->saillieMT,$request->e1r,$request->etageMT,$request->nbcoucheMT,$request->canauxBt,$request->lgCales,$request->nbrPapierMT,$request->ep1PapierMT);
            $dext=$this->Dext($DintBint,$epx);
            $bext=$this->Bext($DintBint,$epy);
            $poid=$this->Poid($request->materiau,$projet->N1c,$scu1,$DintBint,$epx,$request->majPoid);
            $EpaisseurPapierCanaux=$request->canauxNbrPapier*$request->EpfeuillePapier;
            $N1cmax=$this->N1cmax($projet->spire);

            $spchb=$this->spchb($request->conducteur,$N1cmax,$request->nbcoucheMT);
            $ncha=$this->ncha($request->nbcoucheMT,$spchb,$N1cmax);
            $nchb=$this->nchb($request->nbcoucheMT,$ncha);
            $spcha=$this->spcha($spchb);
            $HcondMt=$this->hcondMt($Isole,$spchb,$request->brinParallele);
            $Hcollier=$this->Hcollier($projet->HbobineBtSec,$HcondMt);
            $nbrPapierMT=$this->NbrePapier($request->conducteur,$request->rigiditePapierMT,$spchb,$projet->Vsp,$Isole,$Designation,$request->EpfeuillePapier);

            $epaisseurPapier=$this->epaisseurPapier($request->EpfeuillePapier, $nbrPapierMT);
            $EpxMt=$this->EpxMt($request->typeCanaux,$request->nbcoucheMT,$Isole,$epaisseurPapier,$request->canauxMT,$request->lgCales,$EpaisseurPapierCanaux);
            $dintMt=$this->dintMt($projet->DextBT,$request->DistanceBTMT);
            $bintMt=$this->bintMt($projet->BextBT,$request->DistanceBTMT,$projet->epaisseurBarreBT,$projet->conducteurSec);
   if($request->typeCanaux=="complet"){
                $epyMtLune=$EpxMt;
            }else if($request->typeCanaux=="lune"){
                $epyMtLune=$this->epyMtLune($request->nbcoucheMT,$Isole,$epaisseurPapier,$request->canauxMT,$request->lgCales);
            }
            $dextMt=$this->dextMt($dintMt,$EpxMt);
            $BextMt=$this->BextMt($bintMt,$epyMtLune);
            $poidEmaille=$this->poidEmaille($request->materiau,$dextMt,$dintMt,$dintMt,$request->majPoid,$dextMt,$N1cmax,$scu1);
//FEUILLARD
$barre=$this->calculBarre($request->Epbarre);
$HbobineBt= $this->Hbobine($request->Hfeuillard,$request->collierBT);
$ePap=$this->ePap($request->ep1Papier,$request->nbrPap1,$request->ep2Papier,$request->nbrPap2);
$epxfeui=$this->Epxfeui($request->typeCanaux,$projet->N2c,$request->canauxBt,$request->lgCales,$epFeuillard,$ePap);
$epFeuilpap=$this->epPapier($request->epFeuilPap,$request->nbrPapier);
$epPapier=$this->epPapier($epFeuilpap,$request->nbPapier);
if($barre!=null){
$Sbarre=$this->Sbarre($request->conducteur,$barre->epaisseur,$barre->largeur);
$Jbarre=$this->Jbarre($request->conducteur,$projet->PrimaireIPhase,$Sbarre);
$dextfeui=$this->Dext($DintBint,$epxfeui);
$Bextfeui=$this->Bextfeui($DintBint,$epxfeui,$barre->epaisseur);
$PoidFeui=$this->PoidFeui($request->materiau,$dextfeui,$DintBint,$DintBint,$request->majPoid,$Bextfeui,$projet->N2c,$scu1);
}
          if($request->conducteur=='meplat guipé'){
                $Bobinage->update([
                        'materiau'=> $request->materiau,
                        'conducteur'=> $request->conducteur,
                        'etageMT'=> $request->etageMT ,
                        'saillieMT'=> $request->saillieMT ,
                        'hbrin1MT'=> $request->hbrin1MT ,
                        'hbrin2MT'=> $request->hbrin2MT ,
                        'nbBrin1MT'=>$request->nbBrin1MT ,
                        'nbBrin2MT'=>$request->nbBrin2MT ,
                        'scu1'=>$scu1 ,
                        'j1'=>$j1 ,
                        'nbcoucheMT'=>$request->nbcoucheMT ,
                        'spCoucheMT'=>$spCouche ,
                        'e1ax'=>$request->e1ax ,
                        'e1r'=>$request->e1r ,
                        'rigiditePapierMT'=>$request->rigiditePapierMT ,
                        'ep1PapierMT'=>$request->ep1PapierMT,
                        'nbrPapierMT'=>$request->nbrPapierMT ,
                        'typeCanaux'=>$request->typeCanaux,
                        'canauxMT'=>$request->canauxMT ,
                        'lgCales'=>$request->lgCales ,
                        'canauxEp1Papier'=>$request->canauxEp1Papier,
                        'canauxNbrPapier'=>$request->canauxNbrPapier ,
                        'Hspire'=>$hSpire ,
                        'HSFS'=>$hsfs ,
                        'HFS'=>$hfs ,
                        'collierBT'=>$request->collierBT ,
                        'collierBT2'=> $collierBt2 ,
                        'CMBT'=>$projet->CMBT ,
                        'DintMT'=>$DintBint ,
                        'BintMT'=>$DintBint ,
                        'EpxMT'=>$epx ,
                        'EpyMT'=>$epy ,
                        'DextMT'=>$dext ,
                        'BextMT'=>$bext ,
                        'poidMT'=>$poid ,
                        'majPoid'=>$request->majPoid ,
                        ]);

            }else if($request->conducteur=='Rond emaille'){

                $Bobinage->update([
                    'materiau'=> $request->materiau,
                    'conducteur'=> $request->conducteur,
                    'scu1'=>$scu1 ,
                    'j1'=>$j1 ,
                    'nbrPapierMT'=>$nbrPapierMT ,
                    'typeCanaux'=>$request->typeCanaux,
                    'canauxMT'=>$request->canauxMT ,
                    'lgCales'=>$request->lgCales ,
                    'DintMT'=>Ceil($dintMt) ,
                    'BintMT'=>Ceil($bintMt) ,
                    'EpxMT'=>$EpxMt ,
                    'EpyMT'=>$epyMtLune ,
                    'DextMT'=>round($dextMt) ,
                    'BextMT'=>$BextMt ,
                    'poidMT'=>$poidEmaille ,
                    'majPoid'=>$request->majPoid ,
                    'HbobineBt'=>$projet->HbobineBt ,
                    'EpCylindre'=>$request->EpCylindre  ,
                    'rigiditePapierMT'=>$request->rigiditePapierMT ,
                     'N1cmax'=>$N1cmax,
                    'scu1d'=>$su1d ,
                    'J1D'=>$request->J1D ,
                    'D1d'=>$D1d ,
                    'filobtenueNue'=>$Designation ,
                    'filobtenueIsoler'=>$Isole ,
                    'choix'=>$request->choix ,
                     'brinParallele'=>$request->brinParallele ,
                    'nbcoucheMT'=>$request->nbcoucheMT ,
                    'SpchB'=>$spchb ,
                    'NchB'=>$nchb ,
                    'SpchA'=>$spcha ,
                    'NchA'=>$ncha ,
                    'HCondMt'=>$HcondMt ,
                    'DistanceBTMT'=>$request->DistanceBTMT ,
                    'HCollier'=>$Hcollier ,
                    'EpfeuillePapier'=>$request->EpfeuillePapier ,
                    'EpaiseurPapier'=>$epaisseurPapier ,
                    'EpaisseurPapierCanaux'=>$EpaisseurPapierCanaux ,
                    'canauxNbrPapier'=>$request->canauxNbrPapier ,
                    ]);
            }else if($request->conducteur=='feuillard'){

                $Bobinage->update([
                    'materiau'=> $request->materiau,
                    'conducteur'=> $request->conducteur,
                    'scu1'=>$scu1 ,
                    'j1'=>$j1 ,
                    'ep1PapierMT'=>$request->ep1PapierMT ,
                    'nbrPapierMT'=>$request->nbrPapierMT ,
                    'typeCanaux'=>$request->typeCanaux ,
                    'canauxMT'=>$request->canauxMT ,
                    'lgCales'=>$request->lgCales ,
                    'collierBT'=>$request->collierBT ,
                    'collierBT2'=> $collierBt2 ,
                    'CMBT'=>$projet->CMBT ,
                    'DintMT'=>$DintBint ,
                    'BintMT'=>$DintBint ,
                    'EpxMT'=>$epxfeui ,
                    'EpyMT'=>$epxfeui ,
                    'DextMT'=>$dextfeui ,
                    'BextMT'=>$Bextfeui ,
                    'poidMT'=>$PoidFeui ,
                    'majPoid'=>$request->majPoid ,
                    'Hfeuillard'=>$request->Hfeuillard ,
                    'HbobineBt'=>$HbobineBt ,
                    'epFeuil1'=>$request->epFeuil1 ,
                    'epFeuil2'=>$request->epFeuil2 ,
                    'epFeuillard'=>$epFeuillard ,
                    'ep2Papier'=>$request->ep2Papier ,
                    'nbrPap2'=>$request->nbrPap2 ,
                    'ePap'=>$ePap ,
                    'epFeuilPap'=>$epFeuilpap ,
                    'nbrPap1'=>$request->nbrPap1 ,
                    'EpPapier'=>$epPapier ,
                    'EpCylindre'=>$request->EpCylindre ,
                    'Epbarre'=>$request->Epbarre ,
                    // 'designationBarre'=>$request->designationBarre,
                    'epaisseurBarre'=>$barre->epaisseur ,
                    'largeurBarre'=>$barre->largeur ,
                    'Sbarre'=>$Sbarre ,
                    'Jbarre'=>$Jbarre ,
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
