<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminUsuarioControllerTest extends WebTestCase
{
    public function testAdministrarusuarios()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testConsultarusuario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{idUsuario}');
    }

    public function testCrearusuario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/crear');
    }

    public function testEditarusuario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editar');
    }

    public function testHabilitarusuario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/habilitar');
    }

    public function testAdministrarlogs()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/logs');
    }

}
