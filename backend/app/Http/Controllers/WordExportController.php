<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Donnees\Projet;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\DB;
use App\Models\Donnees\Electrique;
use App\Models\Donnees\garantie\Garantie;
use App\Models\Bobinage;
use App\Models\BobinageSec;
use App\Models\Gradin;
use  App\Models\PccUcc;
use App\Models\VoltSpire;
class WordExportController extends Controller
{
    public function wordExport($id)
    {

        $electrique= Electrique::FindOrFail($id);
        $projet = Projet::findOrFail($id);
        $garantie= Garantie::FindOrFail($projet->garantie_id);
        $Bobinage=Bobinage::FindOrFail($id );
        $Bobinagesec=BobinageSec::FindOrFail($id);
        $Gradin = Gradin::FindOrFail($id);
        $pUCC= PccUcc::FindOrFail($id);
        $VoltSpire = VoltSpire::FindOrFail($id);

        $my_template= new TemplateProcessor(storage_path('templateProjet.docx'));

        // $my_template->setValue('colonnes', $electrique->colonnes);
        // $my_template->setValue('appareil', $projet->appareil);
        $my_template->setValue('reference', $projet->reference);
        // $my_template->setValue('client', $projet->client);
        // $my_template->setValue('refClient', $projet->refClient);
        // $my_template->setValue('temperatureMax', $projet->temperatureMax);
        $my_template->setValue('attitudeMax', $projet->attitudeMax);
        // $my_template->setValue('type', $projet->type);
        // $my_template->setValue('remplissage', $projet->remplissage);
        // $my_template->setValue('installation', $projet->installation);
        // $my_template->setValue('montage', $projet->montage);
        // $my_template->setValue('echangeurs', $projet->echangeurs);
        // $my_template->setValue('dielectrique', $projet->dielectrique);
        // $my_template->setValue('fonctionnement', $projet->fonctionnement);
        // $my_template->setValue('refroidissement', $projet->refroidissement);
        $my_template->setValue('frequence', $electrique->frequence);
        $my_template->setValue('u1n', $electrique->u1n);
        $my_template->setValue('u2o', $electrique->u2o);
        // $my_template->setValue('couplagePrimaire', $electrique->couplagePrimaire);
        // $my_template->setValue('couplageSecondaire', $electrique->couplageSecondaire);
        // $my_template->setValue('indiceHoraire', $electrique->indiceHoraire);
        // $my_template->setValue('priseSoustractive', $electrique->priseSoustractive);
        // $my_template->setValue('priseAdditive', $electrique->priseAdditive);
        $my_template->setValue('echelonSousctractive', $electrique->echelonSousctractive);
        $my_template->setValue('echelonAdditive', $electrique->echelonAdditive);
        $my_template->setValue('classeU1', $electrique->classeU1);
        $my_template->setValue('classeU2', $electrique->classeU2);
        $my_template->setValue('puissance', $electrique->puissance);
        $my_template->setValue('couplage', $electrique->couplage);
        $my_template->setValue('tenueFr1', $electrique->tenueFr1);
        $my_template->setValue('tenueChoc1', $electrique->tenueChoc1);
        $my_template->setValue('tenueFr2', $electrique->tenueFr2);
        $my_template->setValue('tenueChoc2', $electrique->tenueChoc2);
        $my_template->setValue('PrimaireUligne', $electrique->PrimaireUligne);
        $my_template->setValue('PrimaireUPhase', $electrique->PrimaireUPhase);
        $my_template->setValue('PrimaireIligne', $electrique->PrimaireIligne);
        $my_template->setValue('PrimaireIPhase', $electrique->PrimaireIPhase);
        $my_template->setValue('secondaireUligne', $electrique->secondaireUligne);
        $my_template->setValue('secondaireUPhase', $electrique->secondaireUPhase);
        $my_template->setValue('secondaireIligne', $electrique->secondaireIligne);
        $my_template->setValue('secondaireIPhase', $electrique->secondaireIPhase);
        // $my_template->setValue('Uz', $electrique->Uz);
        // $my_template->setValue('nbrePosition', $electrique->nbrePosition);
        // $my_template->setValue('option',$garantie->option);
        // $my_template->setValue('elaborateur',$projet->elaborateur);
        // $my_template->setValue('Pog',$garantie->Pog);
        // $my_template->setValue('log',$garantie->log);
        // $my_template->setValue('Pccg',$garantie->Pccg);
        // $my_template->setValue('Uccg',$garantie->Uccg);
        // $my_template->setValue('Ptot',$garantie->Ptot);
        // $my_template->setValue('Poglimit',$garantie->Poglimit);
        // $my_template->setValue('loglimit',$garantie->loglimit);
        // $my_template->setValue('Pccglimit',$garantie->Pccglimit);
        // $my_template->setValue('Uccglimit',$garantie->Uccglimit);
        // $my_template->setValue('Ptotlimit',$garantie->Ptotlimit);
        $my_template->setValue('echauffementHuile',$garantie->echauffementHuile);
        $my_template->setValue('echauffementEnroulement',$garantie->echauffementEnroulement);
        $my_template->setValue('elaborateur',$projet->elaborateur);
        // $my_template->setValue('materiau',$Bobinage->materiau);
        // $my_template->setValue('conducteur',$Bobinage->conducteur);
        $my_template->setValue('nbcoucheMT',$Bobinage->nbcoucheMT);
        $my_template->setValue('sp/coucheMT',$Bobinage->spCouche);
        $my_template->setValue('CMBT',$Bobinage->CMBT);
        $my_template->setValue('DintMT',$Bobinage->DintMT);
        $my_template->setValue('DintMT',$Bobinage->DintMT);
        $my_template->setValue('EpxMT',$Bobinage->EpxMT);
        $my_template->setValue('EpyMT',$Bobinage->EpyMT);
        $my_template->setValue('HCondMt',$Bobinage->HCondMt);
        $my_template->setValue('lgCales',$Bobinage->lgCales);
        $my_template->setValue('HbobineBt',$Bobinage->HbobineBt);
        $my_template->setValue('DextMT',$Bobinage->DextMT);
        $my_template->setValue('DextMT',$Bobinage->DextMT);
        $my_template->setValue('poidMT',$Bobinage->poidMT);
        $my_template->setValue('lgCales',$Bobinagesec->lgCales);
        $my_template->setValue('Dint',$Bobinagesec->Dint);
        $my_template->setValue('Epx',$Bobinagesec->Epx);
        $my_template->setValue('DextBT',$Bobinagesec->DextBT);
        $my_template->setValue('poidBT',$Bobinagesec->poidBT);
        $my_template->setValue('nbcouche',$Bobinagesec->nbcouche);

        $my_template->setValue('DistanceBTMT',$Bobinage->DistanceBTMT);
        $my_template->setValue('Bmax',$VoltSpire->Bmax);
        $my_template->setValue('N2c',$VoltSpire->N2c);
        $my_template->setValue('Vsp',$VoltSpire->Vsp);
        $my_template->setValue('N1c',$VoltSpire->N1c);
        $my_template->setValue('spire[0]',$VoltSpire->spire[0]);
        $my_template->setValue('spire[1]',$VoltSpire->spire[1]);
        $my_template->setValue('spire[2]',$VoltSpire->spire[2]);
        $my_template->setValue('spire[3]',$VoltSpire->spire[3]);
        $my_template->setValue('spire[4]',$VoltSpire->spire[4]);

        // dd($VoltSpire->spire[0]);
        $my_template->setValue('tole',$Gradin->tole);
        $my_template->setValue('diamNominale',$Gradin->diamNominale);
        $my_template->setValue('Snette',$Gradin->Snette);
        $my_template->setValue('Uccr',$pUCC->Uccr);
        $my_template->setValue('pcc1',$pUCC->pcc1);
        $my_template->setValue('Ucca',$pUCC->Ucca);
        $my_template->setValue('Ucc',$pUCC->Ucc);

        try{
            $my_template->saveAs(storage_path( $projet->appareil.'.docx'));
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        return response()->download(storage_path( $projet->appareil.'.docx'));


    }
}
