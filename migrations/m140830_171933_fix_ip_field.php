<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use dektrium\user\migrations\Migration;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class m140830_171933_fix_ip_field extends Migration
{
    public function up()
    {
        if ($this->dbType == 'sqlsrv') {
            // this is needed because we need to drop the constraint SQL created when renaming the column (?)
            $this->dropColumnConstraints('{{%user}}','registration_ip');
        }
        $this->alterColumn('{{%user}}', 'registration_ip', $this->bigInteger());
    }

    public function down()
    {
        $this->alterColumn('{{%user}}', 'registration_ip', $this->integer());
    }
}
