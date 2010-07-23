#!/usr/bin/env php
<?php
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: Publicis Modem Compress
// SOFTWARE RELEASE: 1.0
// COPYRIGHT NOTICE: Copyright (C) 2010 - Jean-Luc Nguyen - Publicis Modem.
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

require 'autoload.php';

$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => ( "Compressing (Minyfying) files (.js, .css) in directories." ),
                                     'use-session' => false,
                                     'use-modules' => false,
                                     'use-extensions' => true ) );

$script->startup();

$sys = eZSys::instance();

$script->initialize();

$list = PmCompress::run();

if ( count( $list ) )
{
    foreach ( $list as $l )
    {
        $cli->output( "Compressed file: ".$l );
    }
    $script->shutdown( 0 );
}
else
{
    $cli->warning( "No files on configured directories. Please verify the directories and files are readable / writable!" );
}

$script->shutdown();

?>
