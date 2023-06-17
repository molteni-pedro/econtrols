<?php

function getService()
{
	// Creates and returns the Analytics service object.

	// Load the Google API PHP Client Library.
	require_once DRUPAL_ROOT . '/sites/all/modules/publicar/inc/google-api-php-client/src/Google/autoload.php';

	// Use the developers console and replace the values with your
	// service account email, and relative location of your key file.
	$service_account_email = 'yellow-box@keen-jigsaw-116111.iam.gserviceaccount.com';
	$key_file_location = DRUPAL_ROOT . '/sites/all/modules/publicar/inc/yellow-box-f17d10f135f2.p12';

	// Create and configure a new client object.
	$client = new Google_Client();
	$client->setApplicationName("HelloAnalytics");
	$analytics = new Google_Service_Analytics($client);
	
	// Read the generated client_secrets.p12 key.
	$key = file_get_contents($key_file_location);
	$cred = new Google_Auth_AssertionCredentials(
				$service_account_email,
				array(Google_Service_Analytics::ANALYTICS_READONLY),
				$key
			);
	
	$client->setAssertionCredentials($cred);
	if($client->getAuth()->isAccessTokenExpired()) {
		$client->getAuth()->refreshTokenWithAssertion($cred);
	}	

	return $analytics;
}

function getprofileId(&$analytics, $domain) {
	$accounts = $analytics->management_accounts->listManagementAccounts();
        //print_r($accounts);
	
	if (count($accounts->getItems()) > 0) {
		$numAccounts = count($accounts->getItems());
		$items = $accounts->getItems();
		$i = 0;
		$itemsAccounts = $accounts->getItems();
		$properties = $analytics->management_webproperties->listManagementWebproperties($itemsAccounts[$i]->getId());
		$itemsProperties = $properties->getItems();
		$profiles = $analytics->management_profiles->listManagementProfiles($itemsAccounts[$i]->getId(), $itemsProperties[0]->getId());
		
		while($i < $numAccounts) {
			$itemsAccounts = $accounts->getItems();
			$properties = $analytics->management_webproperties->listManagementWebproperties($itemsAccounts[$i]->getId());
			$itemsProperties = $properties->getItems();
			$numProperties = count($properties->getItems())."<br><br>";
			$j = 0;
			while($j < $numProperties) {
				$profiles = $analytics->management_profiles->listManagementProfiles($itemsAccounts[$i]->getId(), $itemsProperties[$j]->getId());
				$numProfiles = count($profiles->getItems());
				$itemsProfiles = $profiles->getItems();
                                
				$z = 0;
				while($z < $numProfiles) {
                                    $parse_url = parse_url($itemsProfiles[$z]->websiteUrl);
                                    $domain_profile = $parse_url['host'];
                                    if ($domain_profile == $domain) return $itemsProfiles[$z];
					$z++;
				}
				$j++;
			}
			$i++;
		}
	}
}


function getResults(&$analytics, $profileId, $page) {

	$gaProgileId = "ga:".$profileId;
	$from = "2006-01-01";
	$to = "today";
	$metrics = "ga:visits, ga:visitors, ga:pageviews, ga:avgSessionDuration, ga:bounces, ga:bounceRate, ga:sessions, ga:uniquePageviews, ga:entrances, ga:exitRate";
	$dimensions = "ga:PagePath";
	$sort = "-ga:visits";
	$filters = "ga:PagePath==".$page;
	
	$results['key'][0] = "pagePath";
	$results['key'][1] = "Visits";
	$results['key'][2] = "Visitors";
	$results['key'][3] = "Vageviews";
	$results['key'][4] = "Average Session Duration in Seconds";
	$results['key'][5] = "Bounces";
	$results['key'][6] = "Bounce Rate";
	$results['key'][7] = "Sessions";
	$results['key'][8] = "Unique Page Views";
	$results['key'][9] = "Entrances"; 	
 	$results['key'][10] = "Exit Rate";	
	
	$results['value'] = $analytics->data_ga->get(
							$gaProgileId,
							$from,
							$to,
							$metrics,
							array('filters' => $filters,'dimensions' => $dimensions));
	
	return $results;
}

function parseResults(&$resultsTotals) {
	$total = count($resultsTotals['key']);
	$i = 0;
		
	while ($i < $total) {
		if (count($resultsTotals['value']->getRows()) > 0) {
			$rows = $resultsTotals['value']->getRows();
			$metricValue = $rows[0][$i];
			$final[$resultsTotals['key'][$i]] = $metricValue;
			$i++;
		} else {
			$i++;
		}
	}
	return $final;
}

function getAnalyticsReport($domain, $page) {
	$analytics = getService();
	$profile = getProfileId($analytics, $domain);
	$results = getResults($analytics, $profile->getId(), $page);
	$analyticsReport = parseResults($results);
	$analyticsReport["profileId"] = $profile->getId();
	$analyticsReport["profileName"] = $profile->getName();
	
	return $analyticsReport;
}

