<?php 
function dynamic_property_location_search() {
    try {
        // Prepare the API URL with dynamic parameters
        $url = "https://webapi.resales-online.com/V6/SearchLocations";
        $query_args = array(
            'p_agency_filterid' => 1,
            'p1' => get_theme_value('identifier_id'),
            'p2' => get_theme_value('unique_api_key'),
            'P_sandbox' => TRUE,
            'P_All'=> FALSE,
            'P_SortType' => 2
        );

        // Append query arguments to the URL
        $url = add_query_arg($query_args, $url);

        // Set up the request arguments, like headers if needed
        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'timeout' => 20, // Timeout after 20 seconds
        );

        // Perform the GET request
        $response = wp_remote_get($url, $args);

        // Check for errors
        if (is_wp_error($response)) {
            throw new Exception($response->get_error_message());
        }

        // Retrieve the response body
        $body = wp_remote_retrieve_body($response);

        // Decode the JSON response
        $data = json_decode($body, true);

        // Check if the data was successfully retrieved
        if (empty($data)) {
            throw new Exception('No data received from API or data is empty.');
        }

       // return $data['LocationData']['ProvinceArea']['Locations']['Location']; // Return the fetched data
        return $data; // Return the fetched data


    } catch (Exception $e) {
        // Catch any errors and return the error message
        return 'Error: ' . $e->getMessage();
    }
}