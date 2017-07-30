<?php
/**
 * LandingPages.
 *
 * @copyright Ralf Koester (RK)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Ralf Koester <ralf@familie-koester.de>.
 * @link http://k62.de
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.5 (https://modulestudio.de).
 */

namespace RK\LandingPagesModule\HookSubscriber\Base;

use Zikula\Bundle\HookBundle\Category\FormAwareCategory;
use Zikula\Bundle\HookBundle\HookSubscriberInterface;
use Zikula\Common\Translator\TranslatorInterface;

/**
 * Base class for form aware hook subscriber.
 */
abstract class AbstractImageFormAwareHookSubscriber implements HookSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * ImageFormAwareHookSubscriber constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @inheritDoc
     */
    public function getOwner()
    {
        return 'RKLandingPagesModule';
    }
    
    /**
     * @inheritDoc
     */
    public function getCategory()
    {
        return FormAwareCategory::NAME;
    }
    
    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->translator->__('Image form aware subscriber');
    }

    /**
     * @inheritDoc
     */
    public function getEvents()
    {
        return [
            // Display hook for create/edit forms.
            FormAwareCategory::TYPE_EDIT => 'rklandingpagesmodule.form_aware_hook.images.edit',
            // Process the results of the edit form after the main form is processed.
            FormAwareCategory::TYPE_PROCESS_EDIT => 'rklandingpagesmodule.form_aware_hook.images.process_edit',
            // Display hook for delete forms.
            FormAwareCategory::TYPE_DELETE => 'rklandingpagesmodule.form_aware_hook.images.delete',
            // Process the results of the delete form after the main form is processed.
            FormAwareCategory::TYPE_PROCESS_DELETE => 'rklandingpagesmodule.form_aware_hook.images.process_delete'
        ];
    }
}
