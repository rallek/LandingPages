<?php
/**
 * LandingPages.
 *
 * @copyright Ralf Koester (RK)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Ralf Koester <ralf@familie-koester.de>.
 * @link http://k62.de
 * @link http://zikula.org
 * @version Generated by ModuleStudio 1.0.2 (https://modulestudio.de).
 */

namespace RK\LandingPagesModule\Event\Base;

use Symfony\Component\EventDispatcher\Event;
use RK\LandingPagesModule\Entity\ImageEntity;

/**
 * Event base class for filtering image processing.
 */
class AbstractFilterImageEvent extends Event
{
    /**
     * @var ImageEntity Reference to treated entity instance.
     */
    protected $image;

    /**
     * @var array Entity change set for preUpdate events.
     */
    protected $entityChangeSet = [];

    /**
     * FilterImageEvent constructor.
     *
     * @param ImageEntity $image Processed entity
     * @param array $entityChangeSet Change set for preUpdate events
     */
    public function __construct(ImageEntity $image, $entityChangeSet = [])
    {
        $this->image = $image;
        $this->entityChangeSet = $entityChangeSet;
    }

    /**
     * Returns the entity.
     *
     * @return ImageEntity
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Returns the change set.
     *
     * @return array
     */
    public function getEntityChangeSet()
    {
        return $this->entityChangeSet;
    }
}
