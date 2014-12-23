<?php

/**
 * Migration to import the old subscribed users from the legacy AyrshireMinis.com site
 * into the new User table
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   17-Dec-2014
 */

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;


class Version20141217162533 extends AbstractMigration
{
    /**
     * the old users email address and the date/time they subscribed on
     *
     * @var array
     */
    protected $old_users = array(
        array(
            'email'     => 'crmpicco@aol.co.uk',
            'joined_on' => "2008-03-19 20:17:32"
        ),
        array(
            'email'     => "philnoshoes@yahoo.co.uk",
            'joined_on' => "2008-03-19 20:17:33"
        ),
        array(
            'email'     => "jonathanmegraw5@hotmail.co.uk",
            'joined_on' => "2008-04-03 17:07:06"
        ),
        array(
            'email'     => "libcatclaws@msn.com",
            'joined_on' => "2008-04-16 14:35:53"
        ),
        array(
            'email'     => "blair_Y_mini@hotmail.com",
            'joined_on' => "2008-04-18 15:48:54"
        ),
        array(
            'email'     => "jcullen35@cogeco.ca",
            'joined_on' => "2008-05-16 13:56:55"
        ),
        array(
            'email'     => "a.renucci@sky.com",
            'joined_on' => "2008-08-31 15:41:05"
        ),
        array(
            'email'     => "martincrabb350@hotmail.com",
            'joined_on' => "2009-01-05 18:28:29"
        ),
        array(
            'email'     => "crabster_1971@btinternet.com",
            'joined_on' => "2009-01-05 18:28:43"
        ),
        array(
            'email'     => "elizabethcrabb@hotmail.co.uk",
            'joined_on' => "2009-01-05 18:29:00"
        ),
        array(
            'email'     => "vna_Jackson4040@who-got-mail.com",
            'joined_on' => "2009-04-19 22:37:08"
        ),
        array(
            'email'     => "stephanie.greenish@avid.com",
            'joined_on' => "2010-01-25 18:31:14"
        ),
        array(
            'email'     => "classiccarspec@btconnect.com",
            'joined_on' => "2010-06-29 10:54:21"
        ),
        array(
            'email'     => "sales@ukclassicparts.com",
            'joined_on' => "2010-06-29 10:55:06"
        ),
        array(
            'email'     => "mlenton@ukclassicparts.com",
            'joined_on' => "2010-06-29 10:55:36"
        ),
        array(
            'email'     => "davidecrae@hotmail.co.uk",
            'joined_on' => "2010-07-28 04:28:08"
        ),
        array(
            'email'     => "jmjengstrom@yahoo.com",
            'joined_on' => "2010-10-21 19:24:57"
        ),
        array(
            'email'     => "k15ped@hotmail.co.uk",
            'joined_on' => "2011-04-20 13:00:19"
        ),
        array(
            'email'     => "acotasaali593@ymail.com",
            'joined_on' => "2012-12-19 02:57:32"
        ),
        array(
            'email'     => "matclxi@palosdonar.com",
            'joined_on' => "2013-04-03 09:20:45"
        ),
        array(
            'email'     => "craig_currie@live.co.uk",
            'joined_on' => "2013-05-14 16:56:52"
        )
    );

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        foreach ($this->old_users as $old_user) {
            if ($this->validateUsername($old_user['email']) === true and $this->checkDNSRecord($old_user['email']) === true) {
                $this->addSql("INSERT INTO User (email, joined_on, unsubscribed) VALUES ('" . $old_user['email'] . "', '" . $old_user['joined_on'] . "', 0)");
            }
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        foreach ($this->old_users as $old_user) {
            $this->addSql("DELETE FROM User WHERE email = '" . $old_user['email'] . "'");
        }
    }

    /**
     * Validate the username/email address based on the structure (e.g. username@domain.com)
     *
     * @param $email
     *
     * @return bool
     */
    public function validateUsername($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // email is NOT valid
            return false;
        } else {
            // email is valid
            return true;
        }
    }


    /**
     * Validate the MX line of the DNS record for the host of the email address (e.g. @aol.co.uk)
     *
     * @param $email
     *
     * @return bool
     */
    public function checkDNSRecord($email)
    {
        $mail_parts = explode('@', $email);

        if (checkdnsrr(array_pop($mail_parts), 'MX')) {
            return true;
        } else {
            return false;
        }
    }
}
