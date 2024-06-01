<?php

declare(strict_types=1);

namespace xpocketmc\entity;

use xpocketmc\nbt\tag\CompoundTag;
use xpocketmc\network\mcpe\protocol\types\entity\EntityIds;
use xpocketmc\network\mcpe\protocol\types\entity\EntityMetadataCollection;
use xpocketmc\network\mcpe\protocol\types\entity\EntityMetadataFlags;
use xpocketmc\network\mcpe\protocol\types\entity\EntityMetadataProperties;

class Villager extends Living implements Ageable {
    public const PROFESSION_FARMER = 0;
    public const PROFESSION_LIBRARIAN = 1;
    public const PROFESSION_PRIEST = 2;
    public const PROFESSION_BLACKSMITH = 3;
    public const PROFESSION_BUTCHER = 4;

    private const TAG_PROFESSION = "Profession"; // TAG_Int

    public static function getNetworkTypeId() : string { 
        return EntityIds::VILLAGER; 
    }

    private bool $baby = false;
    private int $profession = self::PROFESSION_FARMER;
    private int $health = 20;
    private bool $isDead = false;
    private array $trades = []; // Placeholder for trades

    protected function getInitialSizeInfo() : EntitySizeInfo {
        return new EntitySizeInfo(1.8, 0.6); // TODO: eye height??
    }

    public function getName() : string {
        return "Villager";
    }

    protected function initEntity(CompoundTag $nbt) : void {
        parent::initEntity($nbt);

        $profession = $nbt->getInt(self::TAG_PROFESSION, self::PROFESSION_FARMER);
        if ($profession > 4 || $profession < 0) {
            $profession = self::PROFESSION_FARMER;
        }
        $this->setProfession($profession);
    }

    public function saveNBT() : CompoundTag {
        $nbt = parent::saveNBT();
        $nbt->setInt(self::TAG_PROFESSION, $this->getProfession());
        return $nbt;
    }

    public function setProfession(int $profession) : void {
        $this->profession = $profession; // TODO: validation
        $this->networkPropertiesDirty = true;
    }

    public function getProfession() : int {
        return $this->profession;
    }

    public function isBaby() : bool {
        return $this->baby;
    }

    public function setBaby(bool $isBaby) : void {
        $this->baby = $isBaby;
        $this->networkPropertiesDirty = true;
    }

    public function getHealth() : int {
        return $this->health;
    }

    public function setHealth(int $health) : void {
        $this->health = $health;
        if ($this->health <= 0) {
            $this->isDead = true;
            $this->onDeath();
        }
    }

    public function isDead() : bool {
        return $this->isDead;
    }

    public function takeDamage(int $amount) : void {
        if ($this->isDead) {
            return;
        }

        $this->setHealth($this->health - $amount);
        if ($this->health <= 0) {
            $this->onDeath();
        }
    }

    protected function onDeath() : void {
        // Handle death (e.g., drop items, play sound, etc.)
        // This is a placeholder method
        $this->isDead = true;
        // Example: $this->dropLoot();
    }

    public function addTrade($trade) : void {
        $this->trades[] = $trade;
    }

    public function getTrades() : array {
        return $this->trades;
    }

    public function interact(Entity $player) : void {
        if ($this->isDead) {
            return;
        }
        // Handle trading interaction with the player
        // This is a placeholder for the trade interaction logic
    }

    protected function syncNetworkData(EntityMetadataCollection $properties) : void {
        parent::syncNetworkData($properties);
        $properties->setGenericFlag(EntityMetadataFlags::BABY, $this->baby);
        $properties->setInt(EntityMetadataProperties::VARIANT, $this->profession);
    }
}
