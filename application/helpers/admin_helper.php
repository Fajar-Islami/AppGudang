<?php
function is_logged_in()
{
    // Instansiasi CodeIgniter (Memanggil library CI)
    $ci = get_instance();

    // belum login
    if (!$ci->session->userdata('user')) {
        redirect('auth');
    }
    // else {
    //     // sudah login

    //     $role_id = $ci->session->userdata('role_id');
    //     // Mengecek berada di controller/ menu mana
    //     $menu = $ci->uri->segment(1);

    //     $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
    //     $menu_id = $queryMenu['id'];

    //     // Query User access
    //     $userAccess = $ci->db->get_where('user_access_menu', [
    //         'role_id' => $role_id,
    //         'menu_id' => $menu_id
    //     ]);

    //     if ($userAccess->num_rows() < 1) {
    //         redirect('auth/blocked');
    //     }
    // }
}

// function check_access($role_id, $menu_id)
// {
//     $ci = get_instance();

//     // $result = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

//     $ci->db->where('role_id', $role_id);
//     $ci->db->where('menu_id', $menu_id);
//     $result = $ci->db->get('user_access_menu');

//     if ($result->num_rows() > 0) {
//         return "checked = 'checked'";
//     }
// }
