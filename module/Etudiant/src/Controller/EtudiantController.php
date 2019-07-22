<?php

namespace Etudiant\Controller;

use Etudiant\Model\EtudiantTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Etudiant\Form\EtudiantForm;
use Etudiant\Model\Etudiant;

class EtudiantController extends AbstractActionController
{
    // Add this property:
    private $table;

    // Add this constructor:
    public function __construct(EtudiantTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
      return new ViewModel([
           'etudiants' => $this->table->fetchAll(),
       ]);
    }

    public function addAction()
    {
        $form = new EtudiantForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $etudiant = new Etudiant();
        $form->setInputFilter($etudiant->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $etudiant->exchangeArray($form->getData());
        $this->table->saveEtudiant($etudiant);
        return $this->redirect()->toRoute('etudiant');
    }

    public function editAction()
   {
       $id = (int) $this->params()->fromRoute('id', 0);

       if (0 === $id) {
           return $this->redirect()->toRoute('etudiant', ['action' => 'add']);
       }


       try {
           $etudiant = $this->table->getEtudiant($id);
       } catch (\Exception $e) {
           return $this->redirect()->toRoute('etudiant', ['action' => 'index']);
       }

       $form = new EtudiantForm();
       $form->bind($etudiant);
       $form->get('submit')->setAttribute('value', 'Edit');

       $request = $this->getRequest();
       $viewData = ['id' => $id, 'form' => $form];

       if (! $request->isPost()) {
           return $viewData;
       }

       $form->setInputFilter($etudiant->getInputFilter());
       $form->setData($request->getPost());

       if (! $form->isValid()) {
           return $viewData;
       }

       $this->table->saveEtudiant($etudiant);

       // Redirect to etudiant list
       return $this->redirect()->toRoute('etudiant', ['action' => 'index']);
   }

   public function deleteAction()
   {
       $id = (int) $this->params()->fromRoute('id', 0);
       if (!$id) {
           return $this->redirect()->toRoute('etudiant');
       }

       $request = $this->getRequest();
       if ($request->isPost()) {
           $del = $request->getPost('del', 'Non');

           if ($del == 'Oui') {
               $id = (int) $request->getPost('id');
               $this->table->deleteEtudiant($id);
           }

           // Redirect to list of etudiants
           return $this->redirect()->toRoute('etudiant');
       }

       return [
           'id'    => $id,
           'etudiant' => $this->table->getEtudiant($id),
       ];
   }
}

?>
