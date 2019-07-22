<?php

namespace Esi\Controller;

use Esi\Model\EsiTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Esi\Form\EsiForm;
use Esi\Model\Esi;

class EsiController extends AbstractActionController
{
    // Add this property:
    private $table;

    // Add this constructor:
    public function __construct(EsiTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
      return new ViewModel([
           'bibliotheques' => $this->table->fetchAll(),
       ]);
    }

    public function accueilAction()
    {
        return new ViewModel();
    }

    public function ecoleAction()
    {
        return new ViewModel();
    }

    public function etudiantAction()
    {
        return new ViewModel();
    }

    public function admissionAction()
    {
        return new ViewModel();
    }

    public function addAction()
    {
        $form = new EsiForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $esi = new Esi();
        $form->setInputFilter($esi->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $esi->exchangeArray($form->getData());
        $this->table->saveEsi($esi);
        return $this->redirect()->toRoute('bibliotheque');
    }

    public function editAction()
   {
       $id = (int) $this->params()->fromRoute('id', 0);

       if (0 === $id) {
           return $this->redirect()->toRoute('bibliotheque', ['action' => 'add']);
       }


       try {
           $esi = $this->table->getEsi($id);
       } catch (\Exception $e) {
           return $this->redirect()->toRoute('bilbliotheque', ['action' => 'index']);
       }

       $form = new EsiForm();
       $form->bind($esi);
       $form->get('submit')->setAttribute('value', 'Edit');

       $request = $this->getRequest();
       $viewData = ['id' => $id, 'form' => $form];

       if (! $request->isPost()) {
           return $viewData;
       }

       $form->setInputFilter($esi->getInputFilter());
       $form->setData($request->getPost());

       if (! $form->isValid()) {
           return $viewData;
       }

       $this->table->saveEsi($esi);

       // Redirect to Esi list
       return $this->redirect()->toRoute('bibliotheque', ['action' => 'index']);
   }

   public function deleteAction()
   {
       $id = (int) $this->params()->fromRoute('id', 0);
       if (!$id) {
           return $this->redirect()->toRoute('bibliotheque');
       }

       $request = $this->getRequest();
       if ($request->isPost()) {
           $del = $request->getPost('del', 'Non');

           if ($del == 'Oui') {
               $id = (int) $request->getPost('id');
               $this->table->deleteEsi($id);
           }

           // Redirect to list of Esis
           return $this->redirect()->toRoute('bibliotheque');
       }

       return [
           'id'    => $id,
           'bibliotheque' => $this->table->getEsi($id),
       ];
   }
}

?>
