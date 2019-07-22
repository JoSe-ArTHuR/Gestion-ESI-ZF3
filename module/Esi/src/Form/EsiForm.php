<?php

namespace Esi\Form;

use Zend\Form\Form;

class EsiForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('bibliotheque');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'titre',
            'type' => 'text',
            'options' => [
                'label' => 'Titre',
            ],
        ]);

        $this->add([
            'name' => 'annee',
            'type' => 'text',
            'options' => [
                'label' => 'Annee',
            ],
        ]);

        $this->add([
            'name' => 'auteur',
            'type' => 'text',
            'options' => [
                'label' => 'Auteur',
            ],
        ]);

        $this->add([
            'name' => 'resume',
            'type' => 'text',
            'options' => [
                'label' => 'Resume',
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
