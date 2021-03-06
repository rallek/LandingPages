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

namespace RK\LandingPagesModule\Base;

use Doctrine\DBAL\Connection;
use RuntimeException;
use Zikula\Core\AbstractExtensionInstaller;

/**
 * Installer base class.
 */
abstract class AbstractLandingPagesModuleInstaller extends AbstractExtensionInstaller
{
    /**
     * Install the RKLandingPagesModule application.
     *
     * @return boolean True on success, or false
     *
     * @throws RuntimeException Thrown if database tables can not be created or another error occurs
     */
    public function install()
    {
        $logger = $this->container->get('logger');
        $userName = $this->container->get('zikula_users_module.current_user')->get('uname');
    
        // Check if upload directories exist and if needed create them
        try {
            $container = $this->container;
            $uploadHelper = new \RK\LandingPagesModule\Helper\UploadHelper(
                $container->get('translator.default'),
                $container->get('filesystem'),
                $container->get('session'),
                $container->get('logger'),
                $container->get('zikula_users_module.current_user'),
                $container->get('zikula_extensions_module.api.variable'),
                $container->getParameter('datadir')
            );
            $uploadHelper->checkAndCreateAllUploadFolders();
        } catch (\Exception $exception) {
            $this->addFlash('error', $exception->getMessage());
            $logger->error('{app}: User {user} could not create upload folders during installation. Error details: {errorMessage}.', ['app' => 'RKLandingPagesModule', 'user' => $userName, 'errorMessage' => $exception->getMessage()]);
        
            return false;
        }
        // create all tables from according entity definitions
        try {
            $this->schemaTool->create($this->listEntityClasses());
        } catch (\Exception $exception) {
            $this->addFlash('error', $this->__('Doctrine Exception') . ': ' . $exception->getMessage());
            $logger->error('{app}: Could not create the database tables during installation. Error details: {errorMessage}.', ['app' => 'RKLandingPagesModule', 'errorMessage' => $exception->getMessage()]);
    
            return false;
        }
    
        // set up all our vars with initial values
        $this->setVar('pageEntriesPerPage', '10');
        $this->setVar('imageEntriesPerPage', '10');
        $this->setVar('enableShrinkingForImagePicture', false);
        $this->setVar('shrinkWidthImagePicture', '800');
        $this->setVar('shrinkHeightImagePicture', '600');
        $this->setVar('thumbnailModeImagePicture',  'inset' );
        $this->setVar('thumbnailWidthImagePictureView', '32');
        $this->setVar('thumbnailHeightImagePictureView', '24');
        $this->setVar('thumbnailWidthImagePictureDisplay', '240');
        $this->setVar('thumbnailHeightImagePictureDisplay', '180');
        $this->setVar('thumbnailWidthImagePictureEdit', '240');
        $this->setVar('thumbnailHeightImagePictureEdit', '180');
        $this->setVar('enabledFinderTypes', [ 'page' ,  'image' ]);
    
        // initialisation successful
        return true;
    }
    
    /**
     * Upgrade the RKLandingPagesModule application from an older version.
     *
     * If the upgrade fails at some point, it returns the last upgraded version.
     *
     * @param integer $oldVersion Version to upgrade from
     *
     * @return boolean True on success, false otherwise
     *
     * @throws RuntimeException Thrown if database tables can not be updated
     */
    public function upgrade($oldVersion)
    {
    /*
        $logger = $this->container->get('logger');
    
        // Upgrade dependent on old version number
        switch ($oldVersion) {
            case '1.0.0':
                // do something
                // ...
                // update the database schema
                try {
                    $this->schemaTool->update($this->listEntityClasses());
                } catch (\Exception $exception) {
                    $this->addFlash('error', $this->__('Doctrine Exception') . ': ' . $exception->getMessage());
                    $logger->error('{app}: Could not update the database tables during the upgrade. Error details: {errorMessage}.', ['app' => 'RKLandingPagesModule', 'errorMessage' => $exception->getMessage()]);
    
                    return false;
                }
        }
    */
    
        // update successful
        return true;
    }
    
    /**
     * Uninstall RKLandingPagesModule.
     *
     * @return boolean True on success, false otherwise
     *
     * @throws RuntimeException Thrown if database tables or stored workflows can not be removed
     */
    public function uninstall()
    {
        $logger = $this->container->get('logger');
    
        try {
            $this->schemaTool->drop($this->listEntityClasses());
        } catch (\Exception $exception) {
            $this->addFlash('error', $this->__('Doctrine Exception') . ': ' . $exception->getMessage());
            $logger->error('{app}: Could not remove the database tables during uninstallation. Error details: {errorMessage}.', ['app' => 'RKLandingPagesModule', 'errorMessage' => $exception->getMessage()]);
    
            return false;
        }
    
        // remove all module vars
        $this->delVars();
    
        // remind user about upload folders not being deleted
        $uploadPath = $this->container->getParameter('datadir') . '/RKLandingPagesModule/';
        $this->addFlash('status', $this->__f('The upload directories at "%path%" can be removed manually.', ['%path%' => $uploadPath]));
    
        // uninstallation successful
        return true;
    }
    
    /**
     * Build array with all entity classes for RKLandingPagesModule.
     *
     * @return array list of class names
     */
    protected function listEntityClasses()
    {
        $classNames = [];
        $classNames[] = 'RK\LandingPagesModule\Entity\PageEntity';
        $classNames[] = 'RK\LandingPagesModule\Entity\ImageEntity';
    
        return $classNames;
    }
}
