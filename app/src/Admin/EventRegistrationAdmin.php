<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Filter\ModelAutocompleteFilter;
use Sonata\Form\Type\CollectionType;

class EventRegistrationAdmin extends AbstractAdmin
{
    protected function configureBatchActions(array $actions): array
    {

        if (
            $this->hasRoute('edit') && $this->hasAccess('edit') &&
            $this->hasRoute('delete') && $this->hasAccess('delete')
        ) {
            $actions['voteMail'] = [
                'ask_confirmation' => true,
                'label' => 'Vote email',
            ];
            $actions['fileRequestMail'] = [
                'ask_confirmation' => true,
                'label' => 'File request email',
            ];
        }

        return $actions;
    }


    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('moviecategories', ModelAutocompleteFilter::class, [
                // in related CategoryAdmin there must be datagrid filter on `title`
                // field to make the autocompletion work
                'field_options' => ['property'=>'category.eventRegistrationCategories.name'],
            ])
            ->add('shortlist')
            ->add('is_votable')
            ->add('is_problematic')
            ->add('onshow')
            ->add('premiere')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('author', null, [
                'header_style' => 'width: 120px',
            ])
            ->add('songtitle', null, [
                'header_style' => 'width: 120px',
            ])
            ->add('video_url', null, [
                'template' => 'Admin/CRUD/list_youtube.html.twig',
                'header_style' => 'width: 120px',
            ])
            ->add('moviecategories', FieldDescriptionInterface::TYPE_ONE_TO_MANY, [
                "editable" => true,

            ])
            ->add('director', FieldDescriptionInterface::TYPE_HTML, [
                'truncate' => [
                    'length' => 50
                ],
                'header_style' => 'width: 120px',
            ])
            ->add('description', FieldDescriptionInterface::TYPE_HTML, [
                'truncate' => [
                    'length' => 150
                ],
                'header_style' => 'width: 120px',
            ])
            ->add('extra_info', FieldDescriptionInterface::TYPE_HTML, [
                'truncate' => [
                    'length' => 150
                ],
                'header_style' => 'width: 120px',
            ])
            ->add('premiere', null, [
                "editable" => true,
                'label' => 'Premieres'
            ])
            ->add('shortlist', null, [
                "editable" => true,
            ])
            ->add('onshow', null, [
                "editable" => true,
                'label' => 'Vetítés'
            ])
            ->add('is_problematic', null, [
                "editable" => true,
                'label' => 'Problémás'
            ])
            ->add('is_votable', null, [
                "editable" => true,
                'label' => 'Közönségszavazás'
            ])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('user', AdminType::class)
            ->add('name')
            ->add('video_url')
            ->add(
                'moviecategories',
                CollectionType::class,
                [
                'by_reference' => false,
                'required' => false,
                ],
                [
                       'edit' => 'inline',
                       'sortable' => 'position',
                        'inline' => 'table',
                  ]
            )
            ->add('keywords', ModelType::class, [
                'property' => "name",
                'multiple' => true,
            ])
            ->add('producer')
            ->add('director')
            ->add('photographer')
            ->add('designer')
            ->add('editor')

            ->add('company')
            ->add('website')
            ->add('address')
            ->add('author')
            ->add('songtitle')
            ->add('length')
            ->add('publisher')
            ->add('song_publish_date', null, [
                'required' => false,
            ])
            ->add('video_publish_date')
            ->add('description')
            ->add('extra_info')
            ->add('budget_category')
            ->add('description')
            ->add('email')
            ->add('created', null, [
                'data' => new \DateTime,
            ])
            ->add('premiere', null, [
                'label' => 'Premieres'
            ])
            ->add('shortlist', null, [
            ])
            ->add('onshow', null, [
                'label' => 'Vetítés'
            ])
            ->add('is_problematic', null, [
                'label' => 'Problémás'
            ])
            ->add('is_votable', null, [
                'label' => 'Közönségszavazás'
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('number')
            ->add('name')
            ->add('author')
            ->add('songtitle')
            ->add('length')
            ->add('publisher')
            ->add('song_publish_date')
            ->add('video_publish_date')
            ->add('producer')
            ->add('director')
            ->add('photographer')
            ->add('designer')
            ->add('editor')
            ->add('technology')
            ->add('categories')
            ->add('budget')
            ->add('description')
            ->add('video_url')
            ->add('created')
            ->add('have_rights')
            ->add('winner')
            ->add('post_image')
            ->add('accept_terms')
            ->add('shortlist')
            ->add('onshow')
            ->add('premiere')
        ;
    }



    public function prePersist($object): void
    {
        $object->setKeywords([]);
        foreach ($object->getKeywords() as $keyword) {
            $keyword->addEventRegistration($object);
        }
    }

    public function preUpdate($object): void
    {
        $object->setKeywords([]);

        foreach ($object->getKeywords() as $keyword) {
            $keyword->addEventRegistration($object);
        }
    }

    protected function configureExportFields(): array
    {
        return [
            'id',
            'user.lastname',
            'user.firstname',
            'user.phone',
            'user.email',
            'author',
            'author',
            'songtitle',
            'length',
            'publisher',
            'song_publish_date',
            'video_publish_date',
            'producer',
            'director',
            'photographer',
            'designer',
            'editor',
            'technology',
            'categories',
            'budget',
            'description',
            'video_url',
            'created',
            'have_rights',
            'winner',
            'post_image',
            'accept_terms',
            'shortlist',
            'onshow',
            'premiere',
            'is_votable',
            'is_problematic',
            'no_premiere',

        ];
    }


}
