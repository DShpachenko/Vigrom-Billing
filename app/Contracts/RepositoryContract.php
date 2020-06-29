<?php

namespace App\Contracts;

/**
 * Контракт репозитория.
 *
 * Interface RepositoryContract
 * @package App\Contracts
 */
interface RepositoryContract
{
    /**
     * Создание новой сущности.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Обновление сущности.
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * Получение всех записей.
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * Удаление сущности.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Получение ограниченного списка через pagination.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 10, $columns = array('*'));

    /**
     * Получение элемента по ip.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'));

    /**
     * Получение элемента по значению.
     *
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = array('*'));
}
