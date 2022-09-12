<?php

namespace App\Controller;

use Doctrine\DBAL\Exception;
use PDOException;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class EventRegistrationAdminController extends CRUDController
{

    /**
     * @throws ModelManagerException
     * @throws \Sonata\AdminBundle\Exception\ModelManagerThrowable
     */
    public function batchActionVoteMail(ProxyQueryInterface $query, AdminInterface $admin, Request $request): RedirectResponse
    {
        $admin->checkAccess('edit');
        $admin->checkAccess('delete');

        $modelManager = $admin->getModelManager();

        $qb = $query->getQueryBuilder();
        $qb->select('DISTINCT '.current($qb->getRootAliases()));

        try {
            $entityManager = $modelManager->getEntityManager($this->admin->getClass());

            $i = 0;
            foreach ($qb->getQuery()->toIterable() as $object) {
                dump($object);
            }

            $entityManager->flush();
            $entityManager->clear();
            $this->addFlash('sonata_flash_success', 'flash_batch_merge_success');

        } catch (PDOException|Exception $exception) {
            throw new ModelManagerException(
                sprintf('Failed to delete object: %s', $this->admin->getClass()),
                (int) $exception->getCode(),
                $exception
            );
        } finally {
            return new RedirectResponse(
                $admin->generateUrl('list', [
                    'filter' => $admin->getFilterParameters()
                ])
            );
        }
    }

}
