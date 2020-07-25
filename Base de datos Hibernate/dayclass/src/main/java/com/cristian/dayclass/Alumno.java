package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import java.util.List;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;


/**
 *
 * @author Cristian
 */
@Entity
@Table(name="Alumno", schema="dayclass")
public class Alumno implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;
    private String apellidoAlum;
    private String contraseniaAlum;
    private int dniAlum;
    private String emailAlum;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaAltaAlumno;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaBajaAlumno;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaNacAlumno;
    private int legajoAlumno;
    private String nombreAlum;
    
    @OneToMany
    private List<ContraseniaRestablecida> contraseniaRestablecida;
    @ManyToOne
    private Permiso permiso;

    public Alumno() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getApellidoAlum() {
        return apellidoAlum;
    }

    public void setApellidoAlum(String apellidoAlum) {
        this.apellidoAlum = apellidoAlum;
    }

    public String getContraseniaAlum() {
        return contraseniaAlum;
    }

    public void setContraseniaAlum(String contraseniaAlum) {
        this.contraseniaAlum = contraseniaAlum;
    }

    public String getEmailAlum() {
        return emailAlum;
    }

    public void setEmailAlum(String emailAlum) {
        this.emailAlum = emailAlum;
    }

    public Date getFechaAltaAlumno() {
        return fechaAltaAlumno;
    }

    public void setFechaAltaAlumno(Date fechaAltaAlumno) {
        this.fechaAltaAlumno = fechaAltaAlumno;
    }

    public Date getFechaBajaAlumno() {
        return fechaBajaAlumno;
    }

    public void setFechaBajaAlumno(Date fechaBajaAlumno) {
        this.fechaBajaAlumno = fechaBajaAlumno;
    }

    public Date getFechaNacAlumno() {
        return fechaNacAlumno;
    }

    public void setFechaNacAlumno(Date fechaNacAlumno) {
        this.fechaNacAlumno = fechaNacAlumno;
    }

    public int getLegajoAlumno() {
        return legajoAlumno;
    }

    public void setLegajoAlumno(int legajoAlumno) {
        this.legajoAlumno = legajoAlumno;
    }

    public String getNombreAlum() {
        return nombreAlum;
    }

    public void setNombreAlum(String nombreAlum) {
        this.nombreAlum = nombreAlum;
    }

    public Permiso getPermiso() {
        return permiso;
    }

    public void setPermiso(Permiso permiso) {
        this.permiso = permiso;
    }

    public int getDniAlum() {
        return dniAlum;
    }

    public void setDniAlum(int dniAlum) {
        this.dniAlum = dniAlum;
    }

    public List<ContraseniaRestablecida> getContraseniaRestablecida() {
        return contraseniaRestablecida;
    }

    public void setContraseniaRestablecida(List<ContraseniaRestablecida> contraseniaRestablecida) {
        this.contraseniaRestablecida = contraseniaRestablecida;
    }

}
