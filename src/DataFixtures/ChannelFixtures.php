<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Channel;
use App\Entity\ChannelGroup;
use App\Repository\ChannelGroupRepository;
use App\Repository\ChannelRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ObjectManager;
use Exception;

class ChannelFixtures extends Fixture
{
    private const GROUP_KEY = 'channelGroup';
    private const NAME_KEY = 'name';
    private const DESCRIPTION_KEY = 'description';
    private const LOGO_URL_KEY = 'logoUrl';
    private const PARENTAL_RATING = 'parentalRating';
    private const TIME_SHIFT_SLIDING_WINDOW_KEY = 'timeShiftSlidingWindow';
    private const ACTIVATED_KEY = 'activated';

    /**
     * @param ObjectManager $objectManager
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function load(ObjectManager $objectManager): void
    {
        /** @var ChannelGroupRepository $channelGroupRepository */
        $channelGroupRepository = $objectManager->getRepository(ChannelGroup::class);

        /** @var ChannelRepository $channelRepository */
        $channelRepository = $objectManager->getRepository(Channel::class);

        $groups = [
            'sports', 'comedies', 'kids'
        ];

        foreach($groups as $groupName) {
            $channelGroup = ChannelGroup::create($groupName);
            $channelGroupRepository->save($channelGroup);
        }

        $channels = [
            [
                self::GROUP_KEY => 'sports',
                self::NAME_KEY => 'CT sport',
                self::DESCRIPTION_KEY => '',
                self::LOGO_URL_KEY => 'https://i.imgur.com/OkHBBTz.jpg',
                self::PARENTAL_RATING => 1,
                self::TIME_SHIFT_SLIDING_WINDOW_KEY => 168, // 7 days
                self::ACTIVATED_KEY => true,
            ],
            [
                self::GROUP_KEY => 'kids',
                self::NAME_KEY => 'Nick Jr.',
                self::DESCRIPTION_KEY => 'Channel for kids',
                self::LOGO_URL_KEY => 'https://i.imgur.com/OkHBBTz.jpg',
                self::PARENTAL_RATING => 0,
                self::TIME_SHIFT_SLIDING_WINDOW_KEY => 72, // 3 days
                self::ACTIVATED_KEY => true,
            ],
            [
                self::GROUP_KEY => 'comedies',
                self::NAME_KEY => 'Comedy Central',
                self::DESCRIPTION_KEY => 'Hardcore comedies',
                self::LOGO_URL_KEY => 'https://i.imgur.com/OkHBBTz.jpg',
                self::PARENTAL_RATING => 2,
                self::TIME_SHIFT_SLIDING_WINDOW_KEY => 0, // 7 days
                self::ACTIVATED_KEY => true,
            ],
            [
                self::GROUP_KEY => 'sports',
                self::NAME_KEY => 'Arena Sport 1',
                self::DESCRIPTION_KEY => 'Netherlands league primary',
                self::LOGO_URL_KEY => 'https://i.imgur.com/OkHBBTz.jpg',
                self::PARENTAL_RATING => 2,
                self::TIME_SHIFT_SLIDING_WINDOW_KEY => 168, // 7 days
                self::ACTIVATED_KEY => false,
            ],
        ];

        foreach ($channels as $channel) {
            $channelGroup = $channelGroupRepository->findByName($channel[self::GROUP_KEY]);

            $channel = Channel::create(
                $channelGroup,
                $channel[self::NAME_KEY],
                $channel[self::LOGO_URL_KEY],
                $channel[self::TIME_SHIFT_SLIDING_WINDOW_KEY],
                $channel[self::PARENTAL_RATING],
                $channel[self::DESCRIPTION_KEY],
                $channel[self::ACTIVATED_KEY],
            );

            $channelRepository->save($channel);
        }
    }

}