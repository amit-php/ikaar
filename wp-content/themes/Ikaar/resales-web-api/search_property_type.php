<?php 
function dynamic_property_type_search() {
    try {
        // Prepare the API URL with dynamic parameters
        $url = "https://webapi.resales-online.com/V6/SearchPropertyTypes";
        $query_args = array(
            'p_agency_filterid' => 1,
            'p1' => get_theme_value('identifier_id'),
            'p2' => get_theme_value('unique_api_key'),
            'P_sandbox' => TRUE
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

        return $data; // Return the fetched data

    } catch (Exception $e) {
        // Catch any errors and return the error message
        return 'Error: ' . $e->getMessage();
    }
}

// Example Usage of the Function
// $agency_filter_id = 1;
// $p1 = '1023133';
// $p2 = 'f9fe74f5822a04af7e4d5c399e8972474e1c3d15';
// $lang = 2; // Language option

// $data = dynamic_property_search($agency_filter_id, $p1, $p2, true, $lang);

// // Output or handle the data
// if (is_string($data)) {
//     echo $data; // Display the error message if there was an issue
// } else {
//     print_r($data); // Display the API data
// }
