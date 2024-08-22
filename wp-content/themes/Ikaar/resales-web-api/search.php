<?php

// Function to fetch data from the API with dynamic query parameters
function fetch_data_from_resales_api($dynamic_params) {
    // Base API URL
    $base_url = 'https://webapi.resales-online.com/V6/SearchProperties';

    // Fixed query parameters
    $fixed_params = [
        'p1' => get_theme_value('identifier_id'),
        'p2' => get_theme_value('unique_api_key'),
        'P_Dimension'=>1,
        'P_Currency'=>'EUR',
    ];

    // Combine fixed and dynamic parameters
    $params = array_merge($fixed_params, $dynamic_params);

    // Build the full URL with query parameters
    $url = add_query_arg($params, $base_url);

    try {
        // Perform GET request
        $response = wp_remote_get($url);

        // Check for WP error
        if (is_wp_error($response)) {
            throw new Exception('Request failed: ' . $response->get_error_message());
        }

        // Get the response body
        $body = wp_remote_retrieve_body($response);

        // Decode JSON response
        $data = json_decode($body, true);

        // Check if JSON decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('JSON decode error: ' . json_last_error_msg());
        }

          // Extract only [transaction] and [property] from the data
          $filtered_data = [];
          if (isset($data['transaction'])) {
              $filtered_data['transaction'] = $data['transaction'];
          }
          if (isset($data['Property'])) {
              $filtered_data['Property'] = $data['Property'];
          }
          if (isset($data['QueryInfo'])) {
            $filtered_data['QueryInfo'] = $data['QueryInfo'];
        }

          $response = array(
                     "status"=>$data['transaction']['status'],
                     "queryinfo"=>$data['QueryInfo'],
                     "code" => 200,
                     "message"=> "propertylist",
                     "result" =>$data['Property'],
                     

          );
          
  
          // Return or process the filtered data
          return $response;

        

    } catch (Exception $e) {
        // Handle exceptions
        $response = array(
            "status"=>$data['transaction']['status'],
            "code" => 401,
            "message"=> $e->getMessage(),
            "result" =>$data['Property']

 );
        return $response;
    }
}
