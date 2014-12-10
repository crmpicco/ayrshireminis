<?php

/**
 * Migration to populate the link table (/links) for the first time
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   10-Dec-2014
 */

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;


/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141210141905 extends AbstractMigration
{
    public function up(Schema $schema)
    {

        $links = array(
            0 => array(
                'name'        => 'British Mini Club',
                'url'         => 'www.britishminiclub.com',
                'description' => 'A club offering membership to mini owners and enthusiasts all over the world'
            ),
            1 => array(
                'name'        => 'The Mini Forum',
                'url'         => 'www.theminiforum.co.uk',
                'description' => 'Your Online Guide To Everything Mini'
            ),
            2 => array(
                'name'        => 'Scottish Mini',
                'url'         => 'www.scottishmini.co.uk',
                'description' => 'Scotlands Online Mini Community'
            ),
            3 => array(
                'name'        => 'Brighton Mini Club',
                'url'         => 'www.brightonminiclub.co.uk',
                'description' => 'A club started in November 1999 based in Brighton, SE England.'
            ),
            4 => array(
                'name'        => 'Mini2',
                'url'         => 'www.mini2.com/forum',
                'description' => 'Fuel for your MINI obsession'
            )
        );

        foreach ($links as $link) {
            $this->addSql("INSERT INTO link (name, url, description) VALUES ('" . $link['name'] . "', '" . $link['url'] . "', '" . $link['description'] . "')");
        }

    }

    public function down(Schema $schema)
    {
        $this->addSql("TRUNCATE link");
    }
}
