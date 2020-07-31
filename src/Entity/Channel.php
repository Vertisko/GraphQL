<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChannelRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Action\NotFoundAction;

/**
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={ "get"={ "controller"=NotFoundAction::class, "read"=false, "output"=false } })
 * @ORM\Entity(repositoryClass=ChannelRepository::class)
 */
class Channel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", options={"default":"1"})
     */
    private bool $activated = true;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $logoUrl;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $parentalRating;

    /**
     * @ORM\Column(type="integer")
     */
    private int $timeShiftSlidingWindow;

    /**
     * @ORM\ManyToOne(targetEntity=ChannelGroup::class)
     */
    private ChannelGroup $channelGroup;

    public static function create(ChannelGroup $channelGroup,
                                  string $name,
                                  string $logoUrl,
                                  int $timeShiftSlidingWindow,
                                  ?int $parentalRating = null,
                                  ?string $description = null,
                                  ?bool $activated = null): self
    {
        $channel = new self();
        $channel->setChannelGroup($channelGroup);
        $channel->setName($name);
        $channel->setDescription($description);
        $channel->setParentalRating($parentalRating);
        $channel->setTimeShiftSlidingWindow($timeShiftSlidingWindow);
        $channel->setLogoUrl($logoUrl);
        $channel->setName($name);

        if(!\is_null($activated)){
            $channel->setActivated($activated);
        }

        return $channel;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool|null
     */
    public function isActivated(): ?bool
    {
        return $this->activated;
    }

    /**
     * @param bool $activated
     */
    public function setActivated(bool $activated): void
    {
        $this->activated = $activated;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    /**
     * @param string $logoUrl
     */
    public function setLogoUrl(string $logoUrl): void
    {
        $this->logoUrl = $logoUrl;
    }

    /**
     * @return int|null
     */
    public function getParentalRating(): ?int
    {
        return $this->parentalRating;
    }

    /**
     * @param int|null $parentalRating
     */
    public function setParentalRating(?int $parentalRating): void
    {
        $this->parentalRating = $parentalRating;
    }

    /**
     * @return int|null
     */
    public function getTimeShiftSlidingWindow(): ?int
    {
        return $this->timeShiftSlidingWindow;
    }

    /**
     * @param int $timeShiftSlidingWindow
     */
    public function setTimeShiftSlidingWindow(int $timeShiftSlidingWindow): void
    {
        $this->timeShiftSlidingWindow = $timeShiftSlidingWindow;
    }

    /**
     * @return ChannelGroup|null
     */
    public function getChannelGroup(): ?ChannelGroup
    {
        return $this->channelGroup;
    }

    /**
     * @param ChannelGroup $channelGroup
     */
    public function setChannelGroup(ChannelGroup $channelGroup): void
    {
        $this->channelGroup = $channelGroup;
    }
}