<?php

namespace EthicalJobs\Tests\SDK\Fixtures;

use GuzzleHttp\Psr7\Response;

class Responses
{
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
				"access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZkMWY1NzhkNDFjZTg3ZTNmMDMzZDE1M2VmYmYzM2EzYmUzMjNjMzgyM2I2MmQ1YjVmOWFlOWU1ODk5YTA0NTZkZDUyMzI4ZGY5ZDg0NjU5In0.eyJhdWQiOiIxIiwianRpIjoiNmQxZjU3OGQ0MWNlODdlM2YwMzNkMTUzZWZiZjMzYTNiZTMyM2MzODIzYjYyZDViNWY5YWU5ZTU4OTlhMDQ1NmRkNTIzMjhkZjlkODQ2NTkiLCJpYXQiOjE1MTgzNjczNzQsIm5iZiI6MTUxODM2NzM3NCwiZXhwIjoxNTQ5OTAzMzc0LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.OSwqhasud92mHs19w1WDJ8cCbOTr_R66I502wOomyvuIPq_dsM4-cC4p5qACgMMTB7MlIecLdwiBmBf_421UVe-E56tKdKCK82EGVSTvMO0zr1849cJxnK9mLKcYhW6PrnvlnFi3sgyMtSyTa8vCQ6PSkqKujvoWmIWznbolqFqcesFU2GVW_e4ZFhov4MZGRXe4qjIbwvmx7dj5ABEpkXZRubIS4cZS_FDvmk2OjOB9FC5Lvk3HPeGWMxCWBytCuX1vqWg2hn2_c-e1iNu7Lr8r9qv4zoPqxuXemR1kzk8IAvxzVeNVaDBaPr4Y7xK0vB2EFSrqelGOErosTO0tIP3hWWRVvJf-F69-86i9_x3ci_b0sqasXA_z78Kipo3Mvu4hNsF96tJv0fzb5UWuWe9p23_mgVGQrgvVt53dycP4sxxvcT_1dmeXjis3YCKRaDbzkN7L_mxYJ9szqExGttHPVXsRRcyupC-MEFiLFxCXa_Qr9BsZce8KFm58xOdP6VphtyvDL_oYIjIG6nertyVbCtXZBfTBQ1_2Rc7Ya0uM-Pn4vCKKg-_EQ5V90bLZL1NfdHcowvtX1eCoMIaXiedGa_WkpeiP_Dpp_m4e5hKzwnUCew-ErFP143Ycii8kh_RbtxugtibYOZdKC6pwhfL88ZqtPQrM47eN9VHTW0c"
			}
		';

		return new Response($status, [], $body);
	}

	/**
	 * Jobs resource response
	 *
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
}