<?php

function cekSession()
{
	$ci = get_instance();
	if(!$ci->session->userdata('role') == 1) {
		redirect('auth');
	} else if(!$ci->session->userdata('role') == 2) {
		redirect('auth');
	}
}

function cekAksesUser()
{
	$ci = get_instance();
	if($ci->session->userdata('role') == 2) {
		redirect('user/penulis');
	}
}

function cekAdminAksesUser()
{
	$ci = get_instance();
	if($ci->session->userdata('role') == 1) {
		redirect('admin/dashboard');
	}
}