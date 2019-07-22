<?php

namespace Etudiant\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class EtudiantTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getEtudiant($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveEtudiant(Etudiant $etudiant)
    {
        $data = [
            'nom' => $etudiant->nom,
            'prenom'  => $etudiant->prenom,
            'age'  => $etudiant->age,
            'universite'  => $etudiant->universite,
        ];

        $id = (int) $etudiant->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getEtudiant($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update etudiant with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteEtudiant($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}

 ?>
