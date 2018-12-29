
output "vpc_id" {
    value = "${module.api_gateway_vpc.vpc_id}"
}
output "security_group" {
    value = "${module.api_gateway_vpc.default_security_group}"
}
output "subnet_private_1" {
    value = "${module.api_gateway_vpc.subnet_private_1}"
}
output "subnet_private_2" {
    value = "${module.api_gateway_vpc.subnet_private_2}"
}
output "nat_gw_eip_1" {
    value = "${module.api_gateway_vpc.nat_gw_ip_1}"
}
output "nat_gw_eip_2" {
    value = "${module.api_gateway_vpc.nat_gw_ip_2}"
}
output "nat_instance_eip_1" {
    value = "${module.api_gateway_vpc.nat_instance_ip_1}"
}
output "nat_instance_eip_2" {
    value = "${module.api_gateway_vpc.nat_instance_ip_2}"
}

