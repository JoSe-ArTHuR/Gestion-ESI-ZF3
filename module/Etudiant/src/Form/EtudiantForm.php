<?php

namespace Etudiant\Form;

use Zend\Form\Form;

class EtudiantForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('etudiant');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'nom',
            'type' => 'text',
            'options' => [
                'label' => 'Nom',
            ],
        ]);

        $this->add([
            'name' => 'prenom',
            'type' => 'text',
            'options' => [
                'label' => 'Prenom',
            ],
        ]);

        $this->add([
            'name' => 'age',
            'type' => 'text',
            'options' => [
                'label' => 'Age',
            ],
        ]);

        $this->add([
            'name' => 'universite',
            'type' => 'text',
            'options' => [
                'label' => 'Universite',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}


 ?>
