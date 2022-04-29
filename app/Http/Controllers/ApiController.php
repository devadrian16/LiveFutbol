<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    protected $client;
	const SEASON = 2021;
	const CUP = 'cup';
	const LEAGUE = 'league';
	const TIMEZONE = 'Europe/Madrid';

	public function __construct(Client $client) 
    {	
		$this->client = $client;
	}

	public function run($uri, $type = 'GET') 
    {
		return json_decode( $this->client->request($type, $uri)->getBody(), true);
	}

	public function getStatus() 
	{
		return $this->run('/status');
	}

	//[--PAISES--]
	public function getCountry($code) 
	{
		$filter = ['code' => $code];
		$country = $this->run('countries'.'?'.http_build_query($filter));
		return $country['response'][0];
	}

	public function getCountryName($name) 
	{
		$filter = ['name' => $name];
		$country = $this->run('countries'.'?'.http_build_query($filter));
		return $country['response'][0];
	}

	//[--EQUIPOS--]
	public function getTeam($idTeam) 
	{
		$filter = ['id' => $idTeam];
		$team = $this->run('teams'.'?'.http_build_query($filter));
		return $team['response'][0];
	}

	public function getTeamsLeague($idLeague) 
	{
		$filter = ['league' => $idLeague, 'season' => self::SEASON];
		return $this->run('teams'.'?'.http_build_query($filter));
	}

	//[--JUGADORES--]
	public function getPlayersTeam($idTeam, $idLeague) {
		$filter = ['team' => $idTeam, 'season' => self::SEASON, 'league' => $idLeague];
		$players = $this->run('players'.'?'.http_build_query($filter));
		return $players;
	}

	public function getPlayersTeamPage($idTeam, $idLeague, $page) {
		$filter = ['team' => $idTeam, 'season' => self::SEASON, 'league' => $idLeague, 'page' => $page];
		$players = $this->run('players'.'?'.http_build_query($filter));
		return $players;
	}

	public function getPlayer($idPlayer) {
		$filter = ['id' => $idPlayer, 'season' => self::SEASON];
		$player = $this->run('players'.'?'.http_build_query($filter));
		return $player['response'][0];
	}

	//[--LIGAS--] 
	public function getLeagueTeam($idTeam) 
	{
		$filter = ['season' => self::SEASON, 'team' => $idTeam, 'type' => self::LEAGUE];
		$league = $this->run('leagues'.'?'.http_build_query($filter));
		return $league['response'][0];
	}

	public function getLeague($idLeague) 
	{
		$filter = ['id' => $idLeague, 'season' => self::SEASON];
		$league = $this->run('leagues'.'?'.http_build_query($filter));
		return $league['response'][0];
	}

	public function getTopScorerLeague($idLeague) {
		$filter = ['league' => $idLeague, 'season' => self::SEASON];
		$goals = $this->run('players/topscorers'.'?'.http_build_query($filter));
		return $goals['response'];
	}

	public function getTopAssistsLeague($idLeague) {
		$filter = ['league' => $idLeague, 'season' => self::SEASON];
		$assists = $this->run('players/topassists'.'?'.http_build_query($filter));
		return $assists['response'];
	}

	public function getTopYellowCardsLeague($idLeague) {
		$filter = ['league' => $idLeague, 'season' => self::SEASON];
		$cards = $this->run('players/topyellowcards'.'?'.http_build_query($filter));
		return $cards['response'];
	}

	public function getTopRedCardsLeague($idLeague) {
		$filter = ['league' => $idLeague, 'season' => self::SEASON];
		$cards = $this->run('players/topredcards'.'?'.http_build_query($filter));
		return $cards['response'];
	}

	//[--COPAS--] 
	public function getCupsCountry($country) 
	{
		$filter = ['season' => self::SEASON, 'country' => $country, 'type' => self::CUP];
		return $this->run('leagues'.'?'.http_build_query($filter));
	}

	public function getCup($idCup) 
	{
		$filter = ['id' => $idCup, 'season' => self::SEASON];
		$cup = $this->run('leagues'.'?'.http_build_query($filter));
		return $cup['response'][0];
	}

	//[--TEMPORADAS--] 
	public function getSeasons() 
	{
		return $this->run('seasons');
	}

	//[--PARTIDOS--] 
	public function getMatchesLeague($idLeague, $round) 
	{
		$filter = ['league' => $idLeague, 'season' => self::SEASON, 'round' => $round, 'timezone' => self::TIMEZONE];
		$matches = $this->run('fixtures'.'?'.http_build_query($filter));
		return $matches['response'];
	}

	public function getLiveScore() {
		$filter = ['live' => 'all', 'timezone' => self::TIMEZONE];
		return $this->run('fixtures'.'?'.http_build_query($filter));
	}

	public function getLiveScoreLeagues($idLeagues) {
		$filter = ['live' => $idLeagues, 'timezone' => self::TIMEZONE];
		$matches = $this->run('fixtures'.'?'.http_build_query($filter));
		return $matches['response'];
	}

	public function getMatchesToday() {
		$now = new \DateTime();
		$filter = ['date' => $now->format('Y-m-d'), 'timezone' => self::TIMEZONE];
		return $this->run('fixtures'.'?'.http_build_query($filter));
	}

	public function getMatchesTodayLeague($idLeague) {
		$now = new \DateTime();
		$filter = ['date' => $now->format('Y-m-d'), 'season' => self::SEASON, 'league' => $idLeague, 'timezone' => self::TIMEZONE];
		$matches = $this->run('fixtures'.'?'.http_build_query($filter));
		return $matches['response'];
	}

	public function getLastMatchesTeam($idTeam, $last) {
		$filter = ['season' => self::SEASON, 'team' => $idTeam, 'last' => $last, 'timezone' => self::TIMEZONE];
		$matches = $this->run('fixtures'.'?'.http_build_query($filter));
		return $matches['response'];
	}

	public function getNextMatchesTeam($idTeam, $next) {
		$filter = ['season' => self::SEASON, 'team' => $idTeam, 'next' => $next, 'timezone' => self::TIMEZONE];
		$matches = $this->run('fixtures'.'?'.http_build_query($filter));
		return $matches['response'];
	}

	//[--SEDES--] 
	public function getVenue($idTeam) 
	{
		$filter = ['team' => $idTeam];
		$venue = $this->run('venues'.'?'.http_build_query($filter));
		return $venue['response'][0];
	}

	//[--CLASIFICACIONES--]
	public function getRanking($idLeague) {
		$filter = ['league' => $idLeague, 'season' => self::SEASON];
		$ranking = $this->run('standings'.'?'.http_build_query($filter));
		return $ranking['response'][0];
	}

	//[--RONDAS--]
	public function getRounds($idLeague) {
		$filter = ['league' => $idLeague, 'season' => self::SEASON];
		$rounds = $this->run('fixtures/rounds'.'?'.http_build_query($filter));
		return $rounds['response'];
	}
}
