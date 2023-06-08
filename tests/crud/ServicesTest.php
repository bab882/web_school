<?php

/**
 * Ce test unitaire couvre les fonctionnalités CRUD (Create, Read, Update, Delete) de l'entité Services. Il teste la création d'une entité Services, la lecture des données, la mise à jour d'une entité, ainsi que la suppression d'une entité. Le test createDummyService() est utilisé pour créer une entité de test dans la base de données.
 */
namespace App\Tests\Entity;

use App\Entity\Services;
use App\Repository\ServicesRepository;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ServicesTest extends KernelTestCase
{
    private ?ServicesRepository $repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->repository = self::$container->get(ServicesRepository::class);
    }

    public function testCreate()
    {
        $service = new Services();
        $service->setName('Service Name');
        $service->setTitle('Service Title');
        $service->setSlug('service-slug');
        $service->setImg('service-img.jpg');
        $service->setDescription('Service description');
        $service->setCreatedAt(new DateTimeImmutable());
        $service->setUpdatedAt(new DateTimeImmutable());
        $service->setPublishedAt(new DateTimeImmutable());

        $this->repository->save($service);

        $this->assertNotNull($service->getId());
    }

    public function testRead()
    {
        $service = $this->createDummyService();
        $persistedService = $this->repository->find($service->getId());

        $this->assertInstanceOf(Services::class, $persistedService);
        $this->assertEquals($service->getName(), $persistedService->getName());
        $this->assertEquals($service->getTitle(), $persistedService->getTitle());
        $this->assertEquals($service->getSlug(), $persistedService->getSlug());
        $this->assertEquals($service->getImg(), $persistedService->getImg());
        $this->assertEquals($service->getDescription(), $persistedService->getDescription());
        $this->assertEquals($service->getCreatedAt(), $persistedService->getCreatedAt());
        $this->assertEquals($service->getUpdatedAt(), $persistedService->getUpdatedAt());
        $this->assertEquals($service->getPublishedAt(), $persistedService->getPublishedAt());
    }

    public function testUpdate()
    {
        $service = $this->createDummyService();
        $newTitle = 'New Service Title';

        $service->setTitle($newTitle);
        $this->repository->save($service);

        $persistedService = $this->repository->find($service->getId());

        $this->assertEquals($newTitle, $persistedService->getTitle());
    }

    public function testDelete()
    {
        $service = $this->createDummyService();

        $this->repository->delete($service);

        $persistedService = $this->repository->find($service->getId());

        $this->assertNull($persistedService);
    }

    protected function createDummyService(): Services
    {
        $service = new Services();
        $service->setName('Service Name');
        $service->setTitle('Service Title');
        $service->setSlug('service-slug');
        $service->setImg('service-img.jpg');
        $service->setDescription('Service description');
        $service->setCreatedAt(new DateTimeImmutable());
        $service->setUpdatedAt(new DateTimeImmutable());
        $service->setPublishedAt(new DateTimeImmutable());

        $this->repository->save($service);

        return $service;
    }
}
