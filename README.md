## About
알리고 스마트문자 서비스 API 연동을 위한 AWS 환경 생성

생성항목:
* VPC
* Private and public subnets
* Internet gateway
* NAT gateway (default: `true`)
* NAT instance (default: `false`. Read [more](https://docs.aws.amazon.com/AmazonVPC/latest/UserGuide/vpc-nat-comparison.html).)
* Elastic IP
* MultiAZ mode for high availability (default: `false`) 
* RDS subnets (default: `false`)

네트워크:
- `10.0.0.0/28` - nat #1
- `10.0.0.16/28` - nat #2
- `10.0.0.32/27` - RDS
- `10.0.0.64/27` - RDS
- `10.0.1.0/24` - app #1
- `10.0.2.0/24` - app #2

## 환경설정

* Terraform 설치
* Serverless 설치
* 알리고 API 인증정보 확인
* 발송 서버 IP 등록

## 사용법

* Terraform 부트스트랩 실행

```
$ cd terraform
$ ./build.sh
```

* Serverless 실행

```
$ cd serverless
$ sls deploy

```

## 설치옵션

* 최소 설치: VPC, NAT gw, w/o rds subnets, w/o multiAZ support 

```
//terraform/main.tf

module "project_vpc" {
  source            = "github.com/espozbob/terraform-aws-vpc-with-private-subnets-and-nat"
  project           = "myproject" // required
}
```

전체 옵션 설치:
```
//terraform/main.tf

module "project_vpc" {
  source            = "github.com/espozbob/terraform-aws-vpc-with-private-subnets-and-nat"
  project           = "myproject" // required
  multi_az          = false
  az_a              = "ap-northeast-2a"  // if multi_az is true, it's required.
  az_b              = "ap-northeast-2b"  // it is for backup, not used for real
  az_c              = "ap-northeast-2c"  
  rds               = false
  nat_mode          = "gateway" // or "instance"
  nat_instance_type = "t2.small"
}
```

## 삭제

서버리스 삭제
```
$ cd serverless
$ sls remove

```

Terraform 삭제
```
$ cd terraform
$ ./destroy.sh
```




## 결과

* `vpc_id` 
* `subnet_public_1`
* `subnet_public_2` (empty if MultiAZ mode disabled)
* `subnet_private_1`
* `subnet_private_2` (empty if MultiAZ mode disabled)
* `subnet_rds_1` (empty if RDS support disabled)
* `subnet_rds_2` (empty if RDS support disabled)
* `db_subnet_group` (empty if RDS support disabled)
* `nat_gw_ip_1` 
* `nat_gw_ip_2` (empty if MultiAZ mode disabled)
* `nat_instance_ip_1` 
* `nat_instance_ip_2` (empty if MultiAZ mode disabled)
* `default_security_group` 
