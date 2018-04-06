<?php
/**
 * Created by PhpStorm.
 * User: Boubaker Ibrahim
 * Date: 06/04/2018
 * Time: 13:05
 */

namespace CupCake\StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="CupCake\StockBundle\Repository\StockRepository")
 */
class Stock
{

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="CupCake\ProduitBundle\Entity\Produit", inversedBy="idProduit")
     * @ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit", nullable=false)
     */
    protected $idProduit;
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="CupCake\PatisserieBundle\Entity\Patisserie", inversedBy="idPatisserie" )
     * @ORM\JoinColumn(name="id_patisserie", referencedColumnName="id_patisserie", nullable=false)
     */
    protected $idPatisserie;

    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param mixed $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     * @return mixed
     */
    public function getIdPatisserie()
    {
        return $this->idPatisserie;
    }

    /**
     * @param mixed $idPatisserie
     */
    public function setIdPatisserie($idPatisserie)
    {
        $this->idPatisserie = $idPatisserie;
    }

    /**
     * @return mixed
     */







}
