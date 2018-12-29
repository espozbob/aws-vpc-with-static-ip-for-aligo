#!/bin/bash


rm -rf .terraform
terraform init && terraform get && terraform plan 
terraform apply 
terraform output -json > ../serverless/vpc.json

