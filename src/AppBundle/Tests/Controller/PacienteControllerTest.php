<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PacienteControllerTest extends WebTestCase
{
    public function testDashboardpaciente()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}');
    }

    public function testBusquedapaciente()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/busqueda');
    }

    public function testCrearpaciente()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/crear/');
    }

    public function testConsultarhistoriacomplementaria()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/historia/complementaria/{idPaciente}');
    }

    public function testCrearhistoriacomplementaria()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/historia/complementaria/');
    }

    public function testEditarhistoriacomplementaria()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/historia/complementaria/');
    }

    public function testEliminarhistoriacomplementaria()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/historia/complementaria/');
    }

    public function testConsultardiagnostico()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/diagnostico/{idPaciente}');
    }

    public function testCreardiagnostico()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/diagnostico/crear/');
    }

    public function testEditardiagnostico()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/diagnostico/editar');
    }

}
