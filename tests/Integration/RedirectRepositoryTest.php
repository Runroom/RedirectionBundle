<?php

namespace Runroom\RedirectionBundle\Tests\Integration;

use Runroom\RedirectionBundle\Repository\RedirectRepository;
use Runroom\RedirectionBundle\Tests\TestCase\DoctrineIntegrationTestBase;

class RedirectRepositoryTest extends DoctrineIntegrationTestBase
{
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new RedirectRepository(static::$entityManager);
    }

    /**
     * @test
     */
    public function itReturnsNullIfItDoesNotFindARedirect()
    {
        $redirect = $this->repository->findRedirect('/it-is-not-there');

        $this->assertNull($redirect);
    }

    /**
     * @test
     */
    public function itReturnsNullIfTheRedirectIsUnpublish()
    {
        $redirect = $this->repository->findRedirect('/it-is-unpublish');

        $this->assertNull($redirect);
    }

    /**
     * @test
     */
    public function itReturnsTheRedirect()
    {
        $redirect = $this->repository->findRedirect('/redirect');

        $this->assertSame([
            'destination' => '/target',
            'httpCode' => '301',
        ], $redirect);
    }

    protected function getDataFixtures(): array
    {
        return ['redirects.yaml'];
    }
}