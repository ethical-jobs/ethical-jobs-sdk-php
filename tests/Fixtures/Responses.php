<?php

namespace EthicalJobs\Tests\SDK\Fixtures;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use EthicalJobs\SDK\ApiClient;
use Illuminate\Support\Facades\App;

class Responses
{
	/**
	 * Authentication response
	 *
	 * @return String
	 */
	public static function token(): string
	{
		return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZkMWY1NzhkNDFjZTg3ZTNmMDMzZDE1M2VmYmYzM2EzYmUzMjNjMzgyM2I2MmQ1YjVmOWFlOWU1ODk5YTA0NTZkZDUyMzI4ZGY5ZDg0NjU5In0';
	}

	/**
	 * Authentication response
	 *
	 * @return GuzzleHttp\Psr7\Response
	 */
	public static function authentication($status = 200)
	{
		$body = '
			{
				"token_type": "Bearer",
				"expires_in": 31536000,
				"access_token": "'.static::token().'"
			}
		';

		return new Response($status, [], $body);
	}


	/**
	 * Job resource response
	 *
	 * @return GuzzleHttp\Psr7\Response
	 */
	public static function job($status = 200)
	{
		$body = '
			{
			  "data": {
			    "entities": {
			      "jobs": {
			        "97954": {
			          "_score": null,
			          "id": 97954,
			          "organisation_id": 4247,
			          "organisation_uid": "MarrickvilleLC",
			          "status": "PENDING",
			          "title": "Paralegal",
			          "locked": false,
			          "locked_by_avatar": "",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            3
			          ],
			          "created_at": 1518420833000
			        }
			    },
			    "result": 97954
			  }
			}
		';

		return new Response($status, [], $body);
	}		

	/**
	 * Jobs resource response
	 *
	 * @param int $status
	 * @return GuzzleHttp\Psr7\Response
	 */
	public static function jobs($status = 200)
	{
		$body = '
			{
			  "data": {
			    "entities": {
			      "jobs": {
			        "97954": {
			          "_score": null,
			          "id": 97954,
			          "organisation_id": 4247,
			          "organisation_uid": "MarrickvilleLC",
			          "status": "PENDING",
			          "title": "Paralegal",
			          "locked": false,
			          "locked_by_avatar": "",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            3
			          ],
			          "created_at": 1518420833000
			        },
			        "97953": {
			          "_score": null,
			          "id": 97953,
			          "organisation_id": 3061,
			          "organisation_uid": "EACHBigSplash",
			          "status": "PENDING",
			          "title": "Mental Health Clinician - Psychological Strategies Team",
			          "locked": false,
			          "locked_by_avatar": "",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            1
			          ],
			          "created_at": 1518418252000
			        },
			        "97952": {
			          "_score": null,
			          "id": 97952,
			          "organisation_id": 7471,
			          "organisation_uid": "TITEB",
			          "status": "PENDING",
			          "title": "Human Resource Officer",
			          "locked": false,
			          "locked_by_avatar": "",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            13
			          ],
			          "created_at": 1518417801000
			        },
			        "97951": {
			          "_score": null,
			          "id": 97951,
			          "organisation_id": 6338,
			          "organisation_uid": "BaptistcareWA",
			          "status": "PENDING",
			          "title": "Physiotherapist - Busselton",
			          "locked": false,
			          "locked_by_avatar": "",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            8
			          ],
			          "created_at": 1518416300000
			        },
			        "97925": {
			          "_score": null,
			          "id": 97925,
			          "organisation_id": 3319,
			          "organisation_uid": "APESMA",
			          "status": "PENDING",
			          "title": "Digital Campaigns Coordinator",
			          "locked": true,
			          "locked_by_avatar": "https://s3-ap-southeast-2.amazonaws.com/ethical-jobs/statics/staff/thao-du-avatar.jpg",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            1
			          ],
			          "created_at": 1518409839000
			        },
			        "97874": {
			          "_score": null,
			          "id": 97874,
			          "organisation_id": 7545,
			          "organisation_uid": "HallamCLC",
			          "status": "PENDING",
			          "title": "Manager",
			          "locked": true,
			          "locked_by_avatar": "https://s3-ap-southeast-2.amazonaws.com/ethical-jobs/statics/staff/alex-marsh-avatar.jpg",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            1
			          ],
			          "created_at": 1518390050000
			        },
			        "97821": {
			          "_score": null,
			          "id": 97821,
			          "organisation_id": 2054,
			          "organisation_uid": "Footprints",
			          "status": "PENDING",
			          "title": "Mental Health Professionals - Multiple positions",
			          "locked": true,
			          "locked_by_avatar": "https://www.gravatar.com/avatar/674d81ed54d84d1971ebb355a0f8c53f.jpg?s=200&d=mm",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            5
			          ],
			          "created_at": 1518151675000
			        },
			        "97763": {
			          "_score": null,
			          "id": 97763,
			          "organisation_id": 7540,
			          "organisation_uid": "Sancta Sophia College",
			          "status": "PENDING",
			          "title": "Marketing, Communications and Development Manager",
			          "locked": true,
			          "locked_by_avatar": "https://s3-ap-southeast-2.amazonaws.com/ethical-jobs/statics/staff/jessica-lawson-avatar.jpg",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            3
			          ],
			          "created_at": 1518141881000
			        },
			        "96765": {
			          "_score": null,
			          "id": 96765,
			          "organisation_id": 7534,
			          "organisation_uid": "PhysioInq",
			          "status": "PENDING",
			          "title": "Insane Support Co-ordinator",
			          "locked": true,
			          "locked_by_avatar": "https://s3-ap-southeast-2.amazonaws.com/ethical-jobs/statics/staff/thao-du-avatar.jpg",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            3
			          ],
			          "created_at": 1518068019000
			        },
			        "96692": {
			          "_score": null,
			          "id": 96692,
			          "organisation_id": 7527,
			          "organisation_uid": "Integrative Psychology",
			          "status": "PENDING",
			          "title": "Psychologist (Private Practice Contractor)",
			          "locked": true,
			          "locked_by_avatar": "https://s3-ap-southeast-2.amazonaws.com/ethical-jobs/statics/staff/jessica-lawson-avatar.jpg",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            1
			          ],
			          "created_at": 1518054816000
			        },
			        "96690": {
			          "_score": null,
			          "id": 96690,
			          "organisation_id": 7527,
			          "organisation_uid": "Integrative Psychology",
			          "status": "PENDING",
			          "title": "Receptionist",
			          "locked": true,
			          "locked_by_avatar": "https://s3-ap-southeast-2.amazonaws.com/ethical-jobs/statics/staff/jessica-lawson-avatar.jpg",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            1
			          ],
			          "created_at": 1518053890000
			        },
			        "96497": {
			          "_score": null,
			          "id": 96497,
			          "organisation_id": 7522,
			          "organisation_uid": "trish",
			          "status": "PENDING",
			          "title": "Administration Assistant",
			          "locked": true,
			          "locked_by_avatar": "https://s3-ap-southeast-2.amazonaws.com/ethical-jobs/statics/staff/alex-marsh-avatar.jpg",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            1
			          ],
			          "created_at": 1517894028000
			        },
			        "96000": {
			          "_score": null,
			          "id": 96000,
			          "organisation_id": 1966,
			          "organisation_uid": "CAA",
			          "status": "PENDING",
			          "title": "Marketing Intern",
			          "locked": true,
			          "locked_by_avatar": "https://s3-ap-southeast-2.amazonaws.com/ethical-jobs/statics/staff/alex-marsh-avatar.jpg",
			          "expired": false,
			          "views": 0,
			          "clicks": "N/A",
			          "locations": [
			            1
			          ],
			          "created_at": 1517383181000
			        }
			      }
			    },
			    "result": [
			      97954,
			      97953,
			      97952,
			      97951,
			      97925,
			      97874,
			      97821,
			      97763,
			      96765,
			      96692,
			      96690,
			      96497,
			      96000
			    ]
			  }
			}
		';

		return new Response($status, [], $body);
	}

	/**
	 * Mocks a Guzzle response stack
	 * 
	 * @param  array  $responses
	 * @return \EthicalJobs\SDK\ApiClient
	 */
	public static function mock(array $responses): ApiClient
	{
        $responseStack = new MockHandler($responses);

        $guzzle = new Client(['handler' => HandlerStack::create($responseStack)]);            

        App::instance(Client::class, $guzzle);

        return App::make(ApiClient::class);
	}
}