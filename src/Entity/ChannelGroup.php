<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChannelGroupRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Action\NotFoundAction;

/**
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={ "get"={ "controller"=NotFoundAction::class, "read"=false, "output"=false } })
 * @ORM\Entity(repositoryClass=ChannelGroupRepository::class)
 */
class ChannelGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    public static function create(string $name): self
    {
        $channelGroup = new self();
        $channelGroup->setName($name);

        return $channelGroup;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}