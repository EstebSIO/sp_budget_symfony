<?php

namespace App\Model;

interface TimeStampInterface
{
    public function getTransactionDateCreation(): ?\DateTimeInterface;

    public function setTransactionDateCreation(\DateTimeInterface $transaction_date_creation);

    public function getTransactionDateModif(): ?\DateTimeInterface;

    public function setTransactionDateModif(\DateTimeInterface $transaction_date_modif);
}