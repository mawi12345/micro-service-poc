#!/bin/bash
export PASSWORD="soa-example"
openssl genrsa -passout env:PASSWORD -out private.pem -aes256 4096
openssl rsa -passin env:PASSWORD -pubout -in private.pem -out public.pem
