<?php namespace Cartalyst\Sentry\Permissions;
/**
 * Part of the Sentry package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Sentry
 * @version    2.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2013, Cartalyst LLC
 * @link       http://cartalyst.com
 */

class SentryPermissions extends BasePermissions implements PermissionsInterface {

	/**
	 * {@inheritDoc}
	 */
	protected function getPreparedPermissions()
	{
		$prepared = array();

		if ( ! empty($this->groupPermissions))
		{
			foreach ($this->groupPermissions as $permissions)
			{
				$this->preparePermissions($prepared, $permissions);
			}
		}

		if ( ! empty($this->userPermissions))
		{
			$this->preparePermissions($prepared, $this->userPermissions);
		}

		return $prepared;
	}

	/**
	 * Does the heavy lifting of perparing permissions.
	 *
	 * @param  array  $prepared
	 * @param  array  $permissions
	 * @return void
	 */
	protected function preparePermissions(array &$prepared, array $permissions)
	{
		foreach ($permissions as $key => $value)
		{
			// If the value is not in the array, we're opting in
			if ( ! array_key_exists($key, $prepared))
			{
				$prepared[$key] = $value;
				continue;
			}

			// If our value is in the array and equals false, it will override
			if ($value === false)
			{
				$prepared[$key] = $value;
			}
		}
	}

}
