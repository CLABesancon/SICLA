<?php

namespace SICLA\AraBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Liste
{


    protected $entites;
	protected $animaux;
	protected $logements;
	protected $regimes;
	protected $loisirs;
	protected $equipements;
	protected $statuts;
	protected $statut_famille;
	protected $groupe_apprenants;

    public function __construct()
    {
		$this->entites=array(
			"animaux"=>array("entity"=>"SICLAAraBundle:TypeAnimal","name"=>"Types d'Animaux"),
			"logements"=>array("entity"=>"SICLAAraBundle:TypeLogement","name"=>"Types de logements"),
			"regimes"=>array("entity"=>"SICLAAraBundle:RegimeAlimentaire","name"=>"Régimes alimentaires"),
			"loisirs"=>array("entity"=>"SICLAAraBundle:Loisir","name"=>"Loisirs"),
			"equipements"=>array("entity"=>"SICLAAraBundle:Equipement","name"=>"Types d'équipements"),
			"statuts"=>array("entity"=>"SICLAAraBundle:StatutAnnonce","name"=>"Statuts d'annonces"),
			"statutfamille"=>array("entity"=>"SICLAAraBundle:StatutFamille","name"=>"Statuts des familles"),
			"groupeapprenants"=>array("entity"=>"SICLAAraBundle:GroupeApprenants","name"=>"Groupe d'apprenants")
		);
    }

	public function getEntites()
	{
		return $this->entites;
	}
	
    public function getAnimaux()
    {
        return $this->animaux;
    }

    public function setAnimaux(ArrayCollection $animaux)
    {
        $this->animaux = $animaux;
    }
	
	public function getLogements()
    {
        return $this->logements;
    }

    public function setLogements(ArrayCollection $logements)
    {
        $this->logements = $logements;
    }
	public function getRegimes()
	{
		return $this->regimes;
	}
	public function setRegimes(ArrayCollection $regimes)
	{
		$this->regimes=$regimes;
	}
	
	public function getLoisirs()
	{
		return $this->loisirs;
	}
	
	public function setLoisirs(ArrayCollection $loisirs)
	{
		$this->loisirs=$loisirs;
	}
	
	public function getEquipements()
	{
		return $this->equipements;
	}
	
	public function setEquipements(ArrayCollection $equipements)
	{
		$this->equipements=$equipements;
	}
	
	public function getStatuts()
	{
		return $this->statuts;
	}
	
	public function setStatuts(ArrayCollection $statuts)
	{
		$this->statuts=$statuts;
	}
	
	public function getStatutfamille()
	{
		return $this->statut_famille;
	}
	
	public function setStatutfamille(ArrayCollection $statutfamille)
	{
		$this->statut_famille=$statutfamille;
	}
	
	public function getGroupeApprenants()
	{
		return $this->groupe_apprenants;
	}
	
	public function setGroupeApprenants(ArrayCollection $groupe_apprenants)
	{
		$this->groupe_apprenants=$groupe_apprenants;
	}
	
}