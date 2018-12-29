
provider "aws" {
  region = "${var.aws_region}"
}



module "api_gateway_vpc" {
    source = "github.com/espozbob/terraform-aws-vpc-with-private-subnets-and-nat"
    project = "apigateway-aligo"
    multi_az= true
    az_a = "${var.az_a}"
    az_b = "${var.az_b}"
    az_c = "${var.az_c}"
    nat_mode = "instance"
    nat_instance_type = "t2.micro"
}
