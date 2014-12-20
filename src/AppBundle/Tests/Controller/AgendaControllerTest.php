<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AgendaControllerTest extends WebTestCase
{
    public function testAgendaprincipal()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/agenda/');
    }

    public function testConsultarcita()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/agenda/cita/');
    }

    public function testEditarcita()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/agenda/cita/editar/');
    }

    public function testEliminarcita()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/agenda/cita/eliminar');
    }

    public function testAjustesagenda()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/agenda/ajustes/');
    }

    public function testCreargabinete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/agenda/ajustes/gabinete');
    }

    public function testEditargabinete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/agenda/ajustes/gabinete/editar/');
    }

    public function testHabilitargabinete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/agenda/ajustes/gabinete/habilitar/');
    }

}
