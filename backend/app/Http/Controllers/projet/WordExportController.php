<?php

namespace App\Http\Controllers\projet;

use App\Http\Controllers\Controller;
use App\Models\Donnees\bobinage\Bobinage;
use App\Models\Donnees\bobinage\BobinageSec;
use App\Models\Donnees\bobinage\DonneBobine;
use App\Models\Donnees\electrique\Electrique;
use App\Models\Donnees\garantie\Garantie;
use App\Models\Donnees\gradin\Gradin;
use App\Models\Donnees\PccUcc;
use App\Models\Donnees\Projet;
use App\Models\Donnees\VoltSpire;
use App\Models\Donnees\Circuitmagnetique;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\DB;

class WordExportController extends Controller
{
    public function wordExport($id)
    {

        $electrique= Electrique::FindOrFail($id);
        $projet = Projet::findOrFail($id);
        $garantie= Garantie::FindOrFail($projet->garantie_id);
        $Bobinage=Bobinage::FindOrFail($id );
        $Bobinagesec=BobinageSec::FindOrFail($id);
        $donne_bobines=DonneBobine::FindOrFail($id);
        $Gradin = Gradin::FindOrFail($id);
        $pUCC= PccUcc::FindOrFail($id);
        $VoltSpire = VoltSpire::FindOrFail($id);
        $cm = Circuitmagnetique::FindOrFail($id);

        $my_template= new TemplateProcessor(storage_path('templateProjet.docx'));
        //generale
        $my_template->setValue('reference', $projet->reference);
        $my_template->setValue('attitudeMax', $projet->attitudeMax);
        $my_template->setValue('type', $projet->type);
        $my_template->setValue('elaborateur',$projet->elaborateur);
        //electrique
        $my_template->setValue('frequence', $electrique->frequence);
        $my_template->setValue('u1n', $electrique->u1n);
        $my_template->setValue('u2o', $electrique->u2o);;
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
        //garantie
        $my_template->setValue('Pog',$garantie->Pog);
        $my_template->setValue('log',$garantie->log);
        $my_template->setValue('Pccg',$garantie->Pccg);
        $my_template->setValue('Uccg',$garantie->Uccg);
        $my_template->setValue('Ptot',$garantie->Ptot);
        $my_template->setValue('echauffementHuile',$garantie->echauffementHuile);
        $my_template->setValue('echauffementEnroulement',$garantie->echauffementEnroulement);
        //bobine donne
        $my_template->setValue('materiauMT',$donne_bobines->materiauMT);
        $my_template->setValue('materiauBT',$donne_bobines->materiauBT);
        //bobine MT
        $my_template->setValue('nbcoucheMT',$Bobinage->nbcoucheMT);
        $my_template->setValue('spCoucheMT',$Bobinage->spCoucheMT);
        $my_template->setValue('nbrPapierMT',$Bobinage->nbrPapierMT);
        $my_template->setValue('EpaiseurPapier',$Bobinage->EpaiseurPapier);
        $my_template->setValue('canauxEp1Papier',$Bobinage->canauxEp1Papier);
        $my_template->setValue('canauxNbrPapier',$Bobinage->canauxNbrPapier);
        $my_template->setValue('canauxMT',$Bobinage->canauxMT);
        $my_template->setValue('lgCales',$Bobinage->lgCales);
        $my_template->setValue('DintMT',$Bobinage->DintMT);
        $my_template->setValue('EpxMT',$Bobinage->EpxMT);
        $my_template->setValue('EpyMT',$Bobinage->EpyMT);
        $my_template->setValue('HCondMt',$Bobinage->HCondMt);
        $my_template->setValue('HbobineBt',$Bobinage->HbobineBt);
        $my_template->setValue('DextMT',$Bobinage->DextMT);
        $my_template->setValue('DextMT',$Bobinage->DextMT);
        $my_template->setValue('DistanceBTMT',$Bobinage->DistanceBTMT);
        $my_template->setValue('poidMT',$Bobinage->poidMT);
        $my_template->setValue('scu1',$Bobinage->scu1);
        $my_template->setValue('j1',$Bobinage->j1);
        $my_template->setValue('J1D',$Bobinage->J1D);
        $my_template->setValue('Hfeuillard',$Bobinage->Hfeuillard);
        $my_template->setValue('epFeuillard',$Bobinage->epFeuillard);
        $my_template->setValue('nbBrin1MT',$Bobinage->nbBrin1MT);
        $my_template->setValue('saillieMT',$Bobinage->saillieMT);
        $my_template->setValue('hbrin1MT',$Bobinage->hbrin1MT);
        $my_template->setValue('filobtenueIsoler',$Bobinage->filobtenueIsoler);
        $my_template->setValue('filobtenueNue',$Bobinage->filobtenueNue);
        //bobine BT
        $my_template->setValue('HCondBt',$Bobinagesec->HCondBt);
        $my_template->setValue('spCoucheBT',$Bobinagesec->spCoucheBT);
        $my_template->setValue('canauxEp1PapierBT',$Bobinagesec->canauxEp1PapierBT);
        $my_template->setValue('canauxNbrPapierBT',$Bobinagesec->canauxNbrPapierBT);
        $my_template->setValue('canauxBT',$Bobinagesec->canauxBT);
        $my_template->setValue('lgCalesBT',$Bobinagesec->lgCalesBT);
        $my_template->setValue('nbrPapierBT',$Bobinagesec->nbrPapierBT);
        $my_template->setValue('DintBT',$Bobinagesec->DintBT);
        $my_template->setValue('EpxBT',$Bobinagesec->EpxBT);
        $my_template->setValue('DextBT',$Bobinagesec->DextBT);
        $my_template->setValue('poidBT',$Bobinagesec->poidBT);
        $my_template->setValue('nbcoucheBT',$Bobinagesec->nbcoucheBT);
        $my_template->setValue('scu2',$Bobinagesec->scu2);
        $my_template->setValue('j2',$Bobinagesec->j2);
        $my_template->setValue('J2D',$Bobinagesec->J2D);
        $my_template->setValue('HfeuillardBT',$Bobinage->HfeuillardBT);
        $my_template->setValue('epFeuillardBT',$Bobinage->epFeuillardBT);
        $my_template->setValue('nbBrin1BT',$Bobinage->nbBrin1BT);
        $my_template->setValue('saillieBT',$Bobinage->saillieBT);
        $my_template->setValue('hbrin1BT',$Bobinage->hbrin1BT);
        $my_template->setValue('filobtenueIsolerBT',$Bobinage->filobtenueIsolerBT);
        $my_template->setValue('filobtenueNueBT',$Bobinage->filobtenueNueBT);
        //voltspire
        $my_template->setValue('Bmax',$VoltSpire->Bmax);
        $my_template->setValue('Bmaxdesire',$VoltSpire->Bmaxdesire);
        $my_template->setValue('N2c',$VoltSpire->N2c);
        $my_template->setValue('Vsp',$VoltSpire->Vsp);
        $my_template->setValue('N1c',$VoltSpire->N1c);
        $spire=$this->spire($VoltSpire->spire);
        $my_template->setValue('spire[0]',$spire[0]);
        $my_template->setValue('spire[1]',$spire[1]);

        $my_template->setValue('spire[2]',$spire[2]);
        $my_template->setValue('spire[3]',$spire[3]);
        $my_template->setValue('spire[4]',$spire[4]);
// dd($spire[4]);
        //gradin
        $my_template->setValue('CMBT',$Gradin->CMBT);
        $my_template->setValue('EpaisseurTot',$Gradin->EpaisseurTot);
        $my_template->setValue('tole',$Gradin->tole);
        $my_template->setValue('diamNominale',$Gradin->diamNominale);
        $my_template->setValue('Snette',$Gradin->Snette);
        $my_template->setValue('largeur[0]',$Gradin->largeur[0]);
        $my_template->setValue('largeur[1]',$Gradin->largeur[1]);
        $my_template->setValue('largeur[2]',$Gradin->largeur[2]);
        $my_template->setValue('largeur[3]',$Gradin->largeur[3]);
        $my_template->setValue('largeur[4]',$Gradin->largeur[4]);
        $my_template->setValue('largeur[5]',$Gradin->largeur[5]);
        $my_template->setValue('largeur[6]',$Gradin->largeur[6]);
        $my_template->setValue('largeur[7]',$Gradin->largeur[7]);
        $my_template->setValue('largeur[8]',$Gradin->largeur[8]);
        $my_template->setValue('largeur[9]',$Gradin->largeur[9]);
        $my_template->setValue('largeur[10]',$Gradin->largeur[10]);
        $my_template->setValue('largeur[11]',$Gradin->largeur[11]);
        $my_template->setValue('largeur[12]',$Gradin->largeur[12]);
        $my_template->setValue('epaisseur [0]',$Gradin->epaisseur [0]);
        $my_template->setValue('epaisseur [1]',$Gradin->epaisseur [1]);
        $my_template->setValue('epaisseur [2]',$Gradin->epaisseur [2]);
        $my_template->setValue('epaisseur [3]',$Gradin->epaisseur [3]);
        $my_template->setValue('epaisseur [4]',$Gradin->epaisseur [4]);
        $my_template->setValue('epaisseur [5]',$Gradin->epaisseur [5]);
        $my_template->setValue('epaisseur [6]',$Gradin->epaisseur [6]);
        $my_template->setValue('epaisseur [7]',$Gradin->epaisseur [7]);
        $my_template->setValue('epaisseur [8]',$Gradin->epaisseur [8]);
        $my_template->setValue('epaisseur [9]',$Gradin->epaisseur [9]);
        $my_template->setValue('epaisseur [10]',$Gradin->epaisseur [10]);
        $my_template->setValue('epaisseur [11]',$Gradin->epaisseur [11]);
        $my_template->setValue('epaisseur [12]',$Gradin->epaisseur [12]);
        //pccucc
        $my_template->setValue('Uccr',$pUCC->Uccr);
        $my_template->setValue('pcc1',$pUCC->pcc1);
        $my_template->setValue('Ucca',$pUCC->Ucca);
        $my_template->setValue('Ucc',$pUCC->Ucc);
        //CM
        $my_template->setValue('pFer',$cm->pFer);
        $my_template->setValue('masseFertot',$cm->masseFertot);
        $my_template->setValue('pFerspecifique',$cm->pFerspecifique);
        $my_template->setValue('Ex',$cm->Ex);
        $my_template->setValue('Hc',$cm->Hc);
        $my_template->setValue('E1',$cm->E1);
        $my_template->setValue('E2',$cm->E2);
        $my_template->setValue('E3',$cm->E3);
        $my_template->setValue('E4',$cm->E4);
        $my_template->setValue('Eh',$cm->Eh);
        $my_template->setValue('Ebc',$cm->Ebc);
        try{
            $my_template->saveAs(storage_path( $projet->appareil.'.docx'));
            return response()->download(storage_path( $projet->appareil.'.docx'));
        }catch(\Exception $e){
            return $e->getMessage();
        }



    }
    public function spire($spire){
        $spire = str_replace("[","",$spire);
        $spire = str_replace("]","",$spire);
        // $spire=explode(',',$spire);
        return $spire;
    }
}
