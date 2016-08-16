<?php

namespace Pixeloid\AppBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class EventRegistrationDatatable
 *
 * @package Pixeloid\AppBundle\Datatables
 */
class EventRegistrationDatatable extends AbstractDatatableView
{

    public function getLineFormatter()
    {
        $formatter = function($line) {
            // $repository = $this->em->getRepository($this->getEntity());
            // $entity = $repository->find($line['id']);
          //  var_dump($line);
            // $categories = $entity->getShortlistCategories();
            // $line['shortlist'] = '';
            $moviecategories = '';
            foreach ($line['moviecategories'] as $cat) {
                if ($cat['shortlist'] == true) {
                    $moviecategories .= '<span class="label label-success">'.$cat['category']['name'].'</span><br>';
                }
                else
                {
                    $moviecategories .= '<span class="label">'.$cat['category']['name'].'</span><br>';
                }
             }
          //  $line['categories'] = $moviecategories;
             $line['video_url'] = '         <div class="yt-player" data-height="150" data-yt="'.$line['video_url'].'"></div>';


             '<a href="'.$line['video_url'].'" target="_blank" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-eye-open"></i> YouTube</a>';

            return $line;
        };

        return $formatter;
    }

    public function buildDatatable()
    {
        $this->features->setFeatures(array(
            'auto_width' => true,
            'defer_render' => false,
            'info' => false,
            'jquery_ui' => false,
            'length_change' => false,
            'ordering' => true,
            'paging' => false,
            'processing' => true,
            'scroll_x' => false,
            'scroll_y' => '',
        //    'searching' => true,
            'server_side' => true,
            'state_save' => true,
            'delay' => 0
        ));

        $this->ajax->setOptions(array(
            'url' => $this->router->generate('eventregistration_results'),
            'type' => 'GET'
        ));
        
        $this->options->setOptions(array(
            'display_start' => 0,
            'dom' => 'lfrtip', // default, but not used because 'use_integration_options' = true
          //  'length_menu' => array(10, 25, 50, 2000),
            'order_classes' => true,
            'order' => [[0, 'asc']],
            'order_multi' => true,
            'page_length' => 5000,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '', // default, but not used because 'use_integration_options' = true
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'responsive' => true,
            'class' => 'table ',
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true
        ));

        $this->columnBuilder
                ->add('id', 'column', array('title' => 'Id',
                    'searchable' => false,))
                ->add('number', 'column', array('title' => '#',
                    'searchable' => false,))
                ->add('name', 'column', array('title' => 'Name',))
          //      ->add('title', 'column', array('title' => 'Title',))
                // ->add('company', 'column', array('title' => 'Company',))
                // ->add('website', 'column', array('title' => 'Website',))
                // ->add('address', 'column', array('title' => 'Address',))
                // ->add('phone', 'column', array('title' => 'Phone',))
              //  ->add('moviecategories.shortlist', 'array', array('title' => 'Shortlist', 'data' => 'moviecategories[, ].shortlist'))
              //  ->add('categories', 'virtual', array('title' => 'Kategóriák'))
             //   ->add('shortlist', 'column', array('title' => 'Shortlist', 'orderable' => true))
                ->add('author', 'column', array('title' => 'Author',))
                ->add('song_title', 'column', array('title' => 'Song_title',))
                // ->add('length', 'column', array('title' => 'Length',))
                // ->add('publisher', 'column', array('title' => 'Publisher',))
                // ->add('song_publish_date', 'column', array('title' => 'Song_publish_date',))
                // ->add('video_publish_date', 'column', array('title' => 'Video_publish_date',))
                // ->add('producer', 'column', array('title' => 'Producer',))
                // ->add('director', 'column', array('title' => 'Director',))
                // ->add('photographer', 'column', array('title' => 'Photographer',))
                // ->add('designer', 'column', array('title' => 'Designer',))
                // ->add('editor', 'column', array('title' => 'Editor',))
                // ->add('technology', 'column', array('title' => 'Technology',))
                // ->add('categories', 'column', array('title' => 'Categories',))
                // ->add('budget', 'column', array('title' => 'Budget',))
                // ->add('description', 'column', array('title' => 'Description',))
                ->add('video_url', 'column', array('title' => 'Video_url','searchable'=>false))
                // ->add('email', 'column', array('title' => 'Email',))
                // ->add('created', 'column', array('title' => 'Created',))
                // ->add('have_rights', 'boolean', array('title' => 'Have_rights',))
                // ->add('accept_terms', 'boolean', array('title' => 'Accept_terms',))
                // ->add('shortlist', 'boolean', array('title' => 'Shortlist',))
                // ->add('user.id', 'column', array('title' => 'User Id',))
                // ->add('user_title.id', 'column', array('title' => 'User_title Id',))
                // ->add('user_title.name', 'column', array('title' => 'User_title Name',))
                // ->add('budget_category.id', 'column', array('title' => 'Budget_category Id',))

                ->add(null, 'action', array(
                    'actions' => array(
                        array(
                            'route' => 'eventregistration_show',
                            'route_parameters' => array(
                                'id' => 'id'
                            ),
                            'label' => 'Adatlap',
                            'attributes' => array(
                                'rel' => 'tooltip',
                                'class' => 'btn btn-default btn-sm',
                                'role' => 'button'
                            ),
                            'role' => 'ROLE_ADMIN',
                        ),
                        // array(
                        //     'route' => 'post_edit',
                        //     'route_parameters' => array(
                        //         'id' => 'id'
                        //     ),
                        //     'label' => $this->translator->trans('dtbundle.post.actions.edit'),
                        //     'icon' => 'glyphicon glyphicon-edit',
                        //     'attributes' => array(
                        //         'rel' => 'tooltip',
                        //         'title' => $this->translator->trans('dtbundle.post.actions.edit'),
                        //         'class' => 'btn btn-primary btn-xs',
                        //         'role' => 'button'
                        //     ),
                        //     'confirm' => true,
                        //     'confirm_message' => 'Are you sure?',
                        //     'role' => 'ROLE_ADMIN',
                        // )
                    )
                ))

                ->add('moviecategories.category.name', 'array', array('visible' => false,'searchable'=>false, 'title' => '', 'data' => 'moviecategories.category.name'))
                ->add('moviecategories.shortlist', 'array', array( 'visible' => false,'searchable'=>false, 'title' => '', 'data' => 'moviecategories[, ].shortlist'))
                    ;

    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'Pixeloid\AppBundle\Entity\EventRegistration';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'eventregistration_datatable';
    }
}
