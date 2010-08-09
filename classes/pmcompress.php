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

class PmCompress
{
	protected $pmCompressIni;

	public function __construct()
	{
	}

	/**
	 * Returns an array of compressed files path.
	 * @return array
	 */
	public function run()
	{
		$pmCompressIni = eZINI::instance( "pmcompress.ini" );
        $directories = $pmCompressIni->variable( 'CompressSettings', 'DirectoryPath' );
		$extensions = $pmCompressIni->variable( 'CompressSettings', 'Extension' );
		
		$aCompressedFiles = array();
			
		foreach ( $directories as $cDir )
		{
			if ( is_dir( $cDir ) )
			{
				$dir = opendir( $cDir );
				
				// Each file
				while ( $file = readdir( $dir ) )
				{
					$filePath = $cDir.$file;
					if ( $file != '.' && $file != '..' && !is_dir( $filePath ) )
					{
						$aFile = explode( '.', $file );
						$fExt = $aFile[count( $aFile ) - 1];
						
						// Accepted extensions
						if ( in_array( $fExt, $extensions ) )
						{
							$content = file_get_contents( $filePath, 'w' );
							// Remove spaces, tabs and new lines
                            // TO OPTIMIZE
							/// $content = str_replace( "\n", "", $content );
							$content = str_replace( "\t", " ", $content );
							$content = str_replace( '  ', ' ', $content );
														
							$fp = fopen( $filePath, 'w' );
							if ( fwrite( $fp, $content ) )
							{
								$aCompressedFiles[] = $filePath;
							}
							fclose( $fp );
						}
					}
				}
			}
			else
			{
				return false;
			}
		}
		
		return $aCompressedFiles;
	}
}

?>
