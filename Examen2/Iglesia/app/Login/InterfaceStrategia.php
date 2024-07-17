<?php
interface InterfaceStrategia {
    public function login(string $identificador, string $password): bool;
}
