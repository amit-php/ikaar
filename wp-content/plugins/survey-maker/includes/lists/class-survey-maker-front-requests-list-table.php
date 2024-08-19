<?php
class Survey_Requests_List_Table extends WP_List_Table{
    private $plugin_name;
   
    public function __construct($plugin_name) {
        $this->plugin_name = $plugin_name;
        parent::__construct( array(
            'singular' => __( 'Result', "survey-maker" ), 
            'plural'   => __( 'Results', "survey-maker" ), 
            'ajax'     => false
        ) );
    }

    public function display_tablenav( $which ) {
        ?>
        <div class="tablenav <?php echo esc_attr( $which ); ?>">

            <div class="alignleft actions">
                <?php $this->bulk_actions( $which ); ?>
            </div>

            <?php
            $this->pagination( $which );
            ?>
            <br class="clear" />
        </div>
        <?php
    }

    public function column_default( $item, $column_name ) {
        switch ( $column_name ) {
            case 'user_id': 
            case 'survey_title':
            case 'request_date':
            case 'status':
            case 'approved':
            case 'id':
                return $item[ $column_name ];
                break;
            default:
                return print_r( $item, true );
        }
    }
    
    function column_cb( $item ) {
        return (
            '<input type="checkbox" >'
        );
    }

    function column_survey_title() {
        return 'User\'s Survey';
    }

    function column_user_id() {
        return "User";
    }

    function column_approved() {
        return sprintf('<input type="button" class="button primary ays_survey_approve_button" value="%s"/>', __("Approve", "survey-maker") );		
    }

    function get_columns() {
        $columns = array(
            'cb'                    => '<input type="checkbox" />',
            'survey_title'          => __( 'Survey Title', "survey-maker" ),
            'user_id'               => __( 'User Name', "survey-maker" ),
            'request_date'          => __( 'Request Date', "survey-maker" ),
            'status'                => __( 'Status', "survey-maker" ),
            'approved'              => __( 'Approved', "survey-maker" ),
            'id'                    => __( 'ID', "survey-maker" ),
        );

        return $columns;
    }
    
    public function get_bulk_actions() {
        $actions = array(
            'mark-as-approved' => __( 'Mark as approved', "survey-maker"),
        );

        return $actions;
    }

    public function prepare_items() {

        $per_page     = 1;

        $columns = $this->get_columns();
        $this->_column_headers = array($columns, array(), array());

        $current_page = 1;
        $total_items  = 1;

        $this->set_pagination_args( array(
            'total_items' => $total_items,
            'per_page'    => $per_page
        ) );

        $requests = array(
            array(
                'id' => '1',
                'survey_id' => '0',
                'category_id' => '1',
                'user_id' => '1',
                'user_ip' => '::1',
                'survey_title' => 'Survey',
                'request_data' => '',
                'request_date' => '2023-10-25 08:27:40',
                'status' =>  'Unpublished',
                'approved' => 'not-approved',
                'options' => '[]',
            )
        );

        $this->items = $requests;
    }
}
