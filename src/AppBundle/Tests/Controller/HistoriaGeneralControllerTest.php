<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HistoriaGeneralControllerTest extends WebTestCase
{
    public function testConsultarhistoriageneral()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/historia/general/{idPaciente}');
    }

    public function testEditardatossemipermanentes()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/semipermanentes/editar');
    }

    public function testCreardatossemipermanentes()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/semipermanentes/crear');
    }

    public function testCrearanamnesis()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/anamnesis/crear');
    }

    public function testEditaranamnesis()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/anamnesis/editar');
    }

    public function testEditardatospersonales()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/personales/editar');
    }

    public function testCreardatospersonales()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/personales/crear');
    }

}
