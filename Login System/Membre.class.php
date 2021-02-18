<?php
class Membre
{
	private $pseudo;
	private $email;
	private $signature;
	private $actif;


	public function envoyerEMAIL($titre, $message)
	{
		mail($this->email, $titre, $message);
	}

	public function bannir()
	{
		$this->actif = false;
		$this->envoyerEMAIL('Vous avez été banni', 'Ne revenez plus !');
	}

	public function getPseudo()
	{
		return $this->pseudo;
	}
	public function setPseudo($nouveauPseudo)
	{
		if (!empty($nouveauPseudo) and strlen($nouveauPseudo) < 15) 
		{
			$this->pseudo = $nouveauPseudo;
		}
		
	}

	public function __construct($idMembre)
}
