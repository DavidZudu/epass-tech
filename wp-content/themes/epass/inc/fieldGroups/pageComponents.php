<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function (): void {
    ACFComposer::registerFieldGroup([
        'name' => 'pageComponents',
        'title' => __('Page Components', 'flynt'),
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageComponents',
                'label' => __('Page Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    // Components\BlockAnchor\getACFLayout(),
                    // Components\BlockImage\getACFLayout(),
                    Components\BlockAccordions\getACFLayout(),
                    Components\BlockAccordionCarousel\getACFLayout(),
                    Components\BlockImageText\getACFLayout(),
                    Components\BlockContentGrid\getACFLayout(),
                    Components\BlockTeam\getACFLayout(),
                    // Components\BlockSpacer\getACFLayout(),
                    // Components\BlockVideoOembed\getACFLayout(),
                    Components\BlockWysiwyg\getACFLayout(),
                    // Components\GridImageText\getACFLayout(),
                    Components\GridPostsArchive\getACFLayout(),
                    Components\BlockPostsCarousel\getACFLayout(),
                    // Components\ListComponents\getACFLayout(),
                    // Components\SliderImages\getACFLayout(),
                    // Components\ReusableComponent\getACFLayout(),
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page'
                ]
            ],
        ],
    ]);
});
