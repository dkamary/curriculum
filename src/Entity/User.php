<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\DeletedAtEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    use CreatedAtEntity;
    use UpdatedAtEntity;
    use DeletedAtEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Asset::class, mappedBy="owner")
     */
    private $assets;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=UserType::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=CompanyType::class, inversedBy="users")
     */
    private $companyType;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $birthplace;

    /**
     * @ORM\ManyToOne(targetEntity=Nationality::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=512)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $town;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity=UserMotivation::class, mappedBy="user")
     */
    private $userMotivations;

    /**
     * @ORM\OneToMany(targetEntity=UserStat::class, mappedBy="user")
     */
    private $userStats;

    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="user")
     */
    private $trainings;

    /**
     * @ORM\OneToMany(targetEntity=Experience::class, mappedBy="user")
     */
    private $experiences;

    /**
     * @ORM\OneToMany(targetEntity=Other::class, mappedBy="user")
     */
    private $others;

    /**
     * @ORM\OneToMany(targetEntity=Favorite::class, mappedBy="owner")
     */
    private $favorites;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $banner;

    public function __construct()
    {
        $this->assets = new ArrayCollection();
        $this->userMotivations = new ArrayCollection();
        $this->userStats = new ArrayCollection();
        $this->trainings = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->others = new ArrayCollection();
        $this->favorites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Asset[]
     */
    public function getAssets(): Collection
    {
        return $this->assets;
    }

    public function addAsset(Asset $asset): self
    {
        if (!$this->assets->contains($asset)) {
            $this->assets[] = $asset;
            $asset->setOwner($this);
        }

        return $this;
    }

    public function removeAsset(Asset $asset): self
    {
        if ($this->assets->contains($asset)) {
            $this->assets->removeElement($asset);
            // set the owning side to null (unless already changed)
            if ($asset->getOwner() === $this) {
                $asset->setOwner(null);
            }
        }

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getType(): ?UserType
    {
        return $this->type;
    }

    public function setType(?UserType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(?int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCompanyType(): ?CompanyType
    {
        return $this->companyType;
    }

    public function setCompanyType(?CompanyType $companyType): self
    {
        $this->companyType = $companyType;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(string $birthplace): self
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getNationality(): ?Nationality
    {
        return $this->nationality;
    }

    public function setNationality(?Nationality $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getAvatar(): ?Asset
    {
        return $this->avatar;
    }

    public function setAvatar(?Asset $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|UserMotivation[]
     */
    public function getUserMotivations(): Collection
    {
        return $this->userMotivations;
    }

    public function addUserMotivation(UserMotivation $userMotivation): self
    {
        if (!$this->userMotivations->contains($userMotivation)) {
            $this->userMotivations[] = $userMotivation;
            $userMotivation->setUser($this);
        }

        return $this;
    }

    public function removeUserMotivation(UserMotivation $userMotivation): self
    {
        if ($this->userMotivations->contains($userMotivation)) {
            $this->userMotivations->removeElement($userMotivation);
            // set the owning side to null (unless already changed)
            if ($userMotivation->getUser() === $this) {
                $userMotivation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserStat[]
     */
    public function getUserStats(): Collection
    {
        return $this->userStats;
    }

    public function addUserStat(UserStat $userStat): self
    {
        if (!$this->userStats->contains($userStat)) {
            $this->userStats[] = $userStat;
            $userStat->setUser($this);
        }

        return $this;
    }

    public function removeUserStat(UserStat $userStat): self
    {
        if ($this->userStats->contains($userStat)) {
            $this->userStats->removeElement($userStat);
            // set the owning side to null (unless already changed)
            if ($userStat->getUser() === $this) {
                $userStat->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Training[]
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    public function addTraining(Training $training): self
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings[] = $training;
            $training->setUser($this);
        }

        return $this;
    }

    public function removeTraining(Training $training): self
    {
        if ($this->trainings->contains($training)) {
            $this->trainings->removeElement($training);
            // set the owning side to null (unless already changed)
            if ($training->getUser() === $this) {
                $training->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setUser($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->contains($experience)) {
            $this->experiences->removeElement($experience);
            // set the owning side to null (unless already changed)
            if ($experience->getUser() === $this) {
                $experience->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Other[]
     */
    public function getOthers(): Collection
    {
        return $this->others;
    }

    public function addOther(Other $other): self
    {
        if (!$this->others->contains($other)) {
            $this->others[] = $other;
            $other->setUser($this);
        }

        return $this;
    }

    public function removeOther(Other $other): self
    {
        if ($this->others->contains($other)) {
            $this->others->removeElement($other);
            // set the owning side to null (unless already changed)
            if ($other->getUser() === $this) {
                $other->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Favorite[]
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorite $favorite): self
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites[] = $favorite;
            $favorite->setOwner($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): self
    {
        if ($this->favorites->contains($favorite)) {
            $this->favorites->removeElement($favorite);
            // set the owning side to null (unless already changed)
            if ($favorite->getOwner() === $this) {
                $favorite->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getBanner(): ?Asset
    {
        return $this->banner;
    }

    public function setBanner(?Asset $banner): self
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get the Job desired by the User
     *
     * @return UserMotivation|null
     */
    public function getTheJob(): ?UserMotivation
    {
        $motivations = $this->getUserMotivations();

        return (count($motivations) && isset($motivations[0])) ? $motivations[0] : null;
    }

    /**
     * Get Featured knowledge
     *
     * @return array
     */
    public function getFeaturedKnowledge(): array
    {
        $others = $this->getOthers();
        $list = [];
        $max = 3;
        $i = 0;
        foreach ($others as $known) {
            /**
             * @var Other $known
             */
            $skills = $known->getOtherSkills();
            foreach ($skills as $s) {
                /**
                 * @var OtherSkill $s
                 */
                $list[] = $s;
            }
        }

        return $list;
    }

    /**
     * Get Experience
     *
     * @return float
     */
    public function getExperienceTime(): float
    {
        $experiences = $this->getExperiences();
        $max = $min = null;
        foreach ($experiences as $exp) {
            /**
             * @var Experience $exp
             */
            if (is_null($max)) {
                $max = !is_null($exp->getEndTime()) ? $exp->getEndTime() : null;
            } elseif (!is_null($exp->getEndTime()) && $max < $exp->getEndTime()) {
                $max = $exp->getEndTime();
            }
            if (is_null($min)) {
                $min = $exp->getStartTime();
            } elseif ($min > $exp->getStartTime()) {
                $min = $exp->getStartTime();
            }
        }
        if (is_null($max)) {
            $max = new DateTime('now');
        }
        if (is_null($min)) {
            $min = new DateTime('now');
        }
        $diff = $max->diff($min, true);
        $xp = $diff->y + ($diff->m / 12);

        return $xp;
    }

    public function getFormattedAddress(): string
    {
        return $this->address . ', ' . $this->zipcode . ', ' . $this->town . ', ' . $this->getCountry()->getName();
    }
}
