<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Complaint Entity
 *
 * @property int $complaint_id
 * @property string $complaint_no
 * @property string $complaint_title
 * @property int $complainant_id
 * @property int $category_id
 * @property int $status_id
 * @property int $priority_id
 * @property int|null $officer_id
 * @property string $location_address
 * @property string $district
 * @property string $details
 * @property string|null $latitude
 * @property string|null $longitude
 * @property bool|null $is_validated
 * @property \Cake\I18n\DateTime|null $deadline_at
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 * @property string|null $attachment_path
 * @property string|null $attachment_name
 *
 * @property \App\Model\Entity\Complainant $complainant
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\RefStatus $status
 * @property \App\Model\Entity\RefPriority $priority
 * @property \App\Model\Entity\Officer $officer
 */
class Complaint extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'complaint_no' => true,
        'complaint_title' => true,
        'complainant_id' => true,
        'category_id' => true,
        'status_id' => true,
        'priority_id' => true,
        'officer_id' => true,
        'location_address' => true,
        'district' => true,
        'details' => true,
        'latitude' => true,
        'longitude' => true,
        'is_validated' => true,
        'deadline_at' => true,
        'attachment_path' => true,
        'attachment_name' => true,
        'created_at' => true,
        'updated_at' => true,
        'complainant' => true,
        'category' => true,
        'status' => true,
        'priority' => true,
        'officer' => true,
    ];
}
